/* IE、Edgeでposition:fixedな要素がスクロール時にガタつく場合の対応策
http://cloud-collector.link/2016/05/08/ie-fixed-scroll-bug/
------------------------------------------------------*/

if(navigator.userAgent.match(/MSIE 10/i) || navigator.userAgent.match(/Trident\/7\./) || navigator.userAgent.match(/Edge\/12\./)) {
$('body').on("mousewheel", function () {
event.preventDefault();
var wd = event.wheelDelta;
var csp = window.pageYOffset;
window.scrollTo(0, csp - wd);
});
}



/* クラス名の付け替え
------------------------------------------------------*/
/*
jQuery(function($) {
  var triggerMonth = $('.trigger-month');
  var triggerList = $('.trigger-list');
  var changeClass = $('.calendar_wrap');

  triggerMonth.click(function() {
    if(changeClass.hasClass('month-type')){
    }else {
      if(changeClass.hasClass('list-type')){
        changeClass.removeClass('list-type').addClass('month-type');
        triggerList.removeClass('carrent');
        triggerMonth.addClass('carrent');
      }else {
        changeClass.addClass('montht-type');
        triggerMonth.addClass('carrent');
      }
    }
  });

  triggerList.click(function() {
    if(changeClass.hasClass('list-type')){
    }else {
      if(changeClass.hasClass('month-type')){
        changeClass.removeClass('month-type').addClass('list-type');
        triggerMonth.removeClass('carrent');
        triggerList.addClass('carrent');
      }else {
        changeClass.addClass('list-type');
        triggerList.addClass('carrent');
      }
    }


  });

});

*/


jQuery(function($) {
  /* matchHeight
  ------------------------------------------------------*/
  $(function(){
    //$('').matchHeight();
    //$('').matchHeight();
    //$('').matchHeight();
    //$('').matchHeight();
    //$('').matchHeight();
    //$('').matchHeight();
    //$('').matchHeight();
    //$('').matchHeight();
    //$('').matchHeight();
  });
});
