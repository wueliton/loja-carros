function syncPosition(el, thumbnailOwl) {
  var $owl_slider = $(this).data('owl.carousel');
  var loop = $owl_slider.options.loop;
  var current = el.item.index;

  if (loop) {
    var count = el.item.count - 1;
    current = Math.round(el.item.index - el.item.count / 2 - 0.5);
    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
  }

  var owl_thumbnail = thumbnailOwl.data('owl.carousel');
  var itemClass = '.' + owl_thumbnail.options.itemClass;

  var thumbnailCurrentItem = thumbnailOwl
    .find(itemClass)
    .removeClass('synced')
    .eq(current);

  thumbnailCurrentItem.addClass('synced');

  if (!thumbnailCurrentItem.hasClass('active')) {
    var duration = 300;
    thumbnailOwl.trigger('to.owl.carousel', [current, duration, true]);
  }
}
