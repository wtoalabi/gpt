<?php
    /**
     * Created by Alabi Olawale
     * Date: 8/13/2019
     */
    declare(strict_types=1);

    namespace App\Models\Base;


    use App\Models\Base\Collections\Pagination;
    use App\Platform\Base\Helpers\Authenticated;
    use App\Models\Exams\Subject;
    use App\Platform\Base\Helpers\Date\FormatTime;
    use Carbon\Carbon;

    trait CustomQuery
    {
        protected $queryBuilder;

        public function scopeFilterQuery($query) {
            $this->queryBuilder = $query;
            $requests = collect(request()->all())->filter();
            $requests->each(function ($value, $query) {
                if (method_exists($this, $query)) {
                    $this->$query($value);
                }
            });
            return $this->queryBuilder->orderQuery();
        }

        public function scopeOrderQuery($query) {
            $request = request('queryPagination');


            if ($request) {
                if(array_key_exists('itemsPerPage', $request) && $request['itemsPerPage'] == -1){
                    $request['itemsPerPage'] = null;
                }
                if (key_exists('sortDesc', $request)) {
                    /*
                   * TODO
                   This flag is needed to cater for vuetify. To be unified soon
                  */
                    $sortDesc = $request['sortDesc'][0] ?? true;
                    $sortBy = $request['sortBy'][0] ?? 'created_at';
                    return $query->orderBy($sortBy, $sortDesc
                        ? 'desc' : 'asc')->paginate($request['itemsPerPage'] ?? 10000000);

                } else {
                    return $query->orderBy($request['sortBy'] ?? 'created_at', $request['sortDirection']
                        ?? 'desc')->paginate($request['rowsPerPage'] ?? 10);
                }
            } else {
                return $query->orderBy($request['sortBy'] ?? 'created_at', $request['sortDirection']
                    ?? 'desc')->paginate($request['rowsPerPage'] ?? 10);
            }
        }

        public function searchMultipleColumns($searchArray) {
            $searchColumns = $searchArray[0];
            $searchText = $searchArray[1];
            if ($searchText) {
                $this->queryBuilder->where($searchColumns[0], 'like', "%$searchText%");
                foreach ($searchColumns as $column) {
                    $this->queryBuilder->orWhere($column, 'like', "%$searchText%");
                }
            }
            return $this->queryBuilder;
        }

        public function filterBySearch($searchArray) {

            $searchColumn = $searchArray[0];

            $searchText = $searchArray[1];
            if ($searchText) {
                if (gettype($searchColumn) == 'array') {
                    collect($searchColumn)->map(function ($column) use ($searchText){
                        if(is_numeric($searchText) ? (int) $searchText : false){
                            return $this->queryBuilder->orWhere($column, 'like', (int) $searchText);
                        }
                         return $this->queryBuilder->orWhere($column, 'like', "%$searchText%");
                    });
                } else {
                    return $this->queryBuilder->where($searchColumn, 'like', "%$searchText%");
                }
            }

            return $this->queryBuilder;

        }

        public function filterByDate($dateArray) {
            if ($dateArray) {
                $from = $dateArray['fromDate'];
                $to = $dateArray['toDate'];
                if ($from && $to) {
                    return $this->queryBuilder->whereBetween('created_at', [$from, $to]);
                } else {
                    return $this->queryBuilder;
                }
            }
            return $this->queryBuilder;
        }

        public function filterByTwoDates($dateArray)
        {
            if (!$dateArray || (!isset($dateArray['from']) && !isset($dateArray['to']))) {
                return $this->queryBuilder;
            }

            $from = isset($dateArray['from']) ? $dateArray['from'] : null;
            $to = isset($dateArray['to']) ? $dateArray['to'] : null;


            if ($from && $to) {
                return $this->queryBuilder->whereBetween('created_at', [$from . " 00:00", $to . " 23:59"]);
            } elseif ($from) {
                return $this->queryBuilder->where('created_at', '>=', $from . " 00:00");
            } else {
                return $this->queryBuilder->where('created_at', '<=', $to . " 23:59");
            }
        }


        public function filterByColumn($queryArray) {
            if ($queryArray) {
                collect($queryArray)->each(function ($each) {
                    $column = $each[0];
                    $value = $each[1];
                    if ($value !== "None") {
                        return $this->queryBuilder->where($column, '=', $value);
                    };
                    return $this->queryBuilder;
                });
            }
            return $this->queryBuilder;
        }

        public
        function filterByRelationship($relationshipArray) {

            collect($relationshipArray)->values()->each(function ($relationship) {
                list($table, $column, $value) = $relationship;
                return $this->queryBuilder->whereHas($table, function ($query) use ($value, $column) {
                    if ($value !== "None") {
                        if(strpos($column, ".id") !== false){
                            return $query->where($column, '=', "$value");
                        }
                        return $query->where($column, 'like', "%$value%");
                    }
                    return $this->queryBuilder;
                });
            });
            return $this->queryBuilder;
        }

        public static function PaginatedCollection($collection) {
            return [
                'data' => $collection,
                'pagination' => Pagination::Get($collection),
                'meta_data' => get_meta()
            ];
        }

        public function filterByAccount($request) {
            $request = collect($request);

            $account_identifier = $request->keys()[0];
            $account_id = $request[$account_identifier];
            $this->queryBuilder->where($account_identifier, $account_id);
        }
    }

    function get_meta(){
        if(request('query_meta_data')){
            $meta = request('query_meta_data');
            if($meta[0] === 'questions_years'){
                $subject =  Subject::find($meta[1]);
                if($subject){
                    return $subject->questions->pluck('year')->unique()->values()->toArray();
                }
            }
        }

        return null;
    }
