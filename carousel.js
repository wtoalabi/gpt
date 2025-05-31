let parent = document.querySelector('.premium-carousel-inner .slick-list .slick-track');
if(parent){
  let arrow = document.querySelector('.premium-carousel-inner .carousel-arrow');
  arrow.addEventListener('click', move);

  var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        move();
      });    
    });
  
    var config = { attributes: true, childList: true, characterData: true };
  
    observer.observe(parent, config);

    function move(){
      let children = parent.querySelectorAll('.slick-slide:not(.slick-cloned)');
      let progress_bar = document.querySelector('.premium-progressbar-bar-wrap .premium-progressbar-bar');
      let sum_total_children_index = sum(get_children_indexes(children))
      let active_children = parent.querySelectorAll('.slick-active');
      let active_sum = sum(get_children_indexes(active_children))+1
      console.log("ACTICVE SUM", active_sum);
      let percentage = ((active_sum/sum_total_children_index)*100)
      progress_bar.style.width = `${percentage}%`;
      console.log(active_sum, sum_total_children_index, percentage);
    }
  
} 


function sum(numbers=[]){
  if(numbers.length === 1){
    return numbers[0];
  }
  return numbers.reduce((partialSum, a) => partialSum + a, 0);
}

function get_children_indexes(children = []){
  let index_array = [];
  for(let i = 0; children.length > i; i++){
      index_array.push(Number.parseInt(children[i].dataset.slickIndex))
  }

  return index_array;
}

