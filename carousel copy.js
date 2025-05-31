window.addEventListener('DOMContentLoaded', function(){
  setTimeout(() => {
let parent = document.querySelector('.premium-carousel-inner .slick-list .slick-track');
if(parent){
  let arrow = document.querySelector('.premium-carousel-inner .carousel-arrow');
  reposition_arrows();
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
      let sum_total_children_index = 0;
      let active_children = parent.querySelectorAll('.slick-active');
      if(active_children.length === 1){
        sum_total_children_index = get_children_indexes(children).length;
      }else{
        sum_total_children_index = sum(get_children_indexes(children));
      }
      let active_sum = sum(get_children_indexes(active_children))+1
      let percentage = ((active_sum/sum_total_children_index)*100)
      progress_bar.style.width = `${percentage}%`;
      console.log(sum_total_children_index,active_sum, percentage);
    }
  
} 
  }, 500);

function sum(numbers=[]){
  return numbers.reduce((partialSum, a) => partialSum + a, 0);
}

function get_children_indexes(children = []){
  let index_array = [];
  for(let i = 0; children.length > i; i++){
      index_array.push(Number.parseInt(children[i].dataset.slickIndex))
  }

  return index_array;
}
function reposition_arrows(){

  let arrows_list = document.querySelectorAll(".premium-carousel-inner .carousel-arrow ");
  let progress_sction =  document.getElementById("progress_section");
  let custom_html_slider = document.getElementById("custom_html_slider");
  let progress_bar = document.getElementById("progress_bar");
  let arrow_left = arrows_list[0];
  let arrow_right = arrows_list[1];
  jQuery(jQuery(arrow_left).detach()).appendTo(custom_html_slider);
  jQuery(jQuery(arrow_right).detach()).appendTo(custom_html_slider);
  change_arrow_icon(arrow_left,'left');
  change_arrow_icon(arrow_right,'right');
  
  function change_arrow_icon(el, direction='left'){
    let i = el.querySelector('i');
    el.type = "";
    if(direction === 'left'){
      el.innerHTML = `<img src='http://michaelk315.sg-host.com/wp-content/uploads/2023/03/previous.png'>`
    }else{
      el.innerHTML = `<img src='http://michaelk315.sg-host.com/wp-content/uploads/2023/03/next.png'>`
    }
  }
}
});

