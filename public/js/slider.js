
document.add_event_listener('DOMContentLoaded', () => {
    let container = document.querySelector('.favorite_slider');
    let scroll_interval;
    let first_item = container.querySelector('.favorite_object');
    let favorite_objects = container.querySelectorAll('.favorite_object:not(.clone)');
    let favorites_count = favorite_objects.length;
    let item_width = first_item.getBoundingClientRect().width;
    let style = window.getComputedStyle(first_item);
    let margin_left = parseFloat(style.margin_left);
    let margin_right = parseFloat(style.margin_right);
    let totalitem_width = item_width + margin_left + margin_right;
    let stop_point = totalitem_width * favorites_count;
    
    
    function start_auto_scroll() {
    scroll_interval = set_interval(function() {
        container.scroll_left += 1;

        if (container.scroll_left >= stop_point) {
            container.scroll_left = 1; 
        }
    }, 20);
}
    if (container && first_item) {
        start_auto_scroll();

        container.add_event_listener('mouseenter', () => {
            clearInterval(scroll_interval); 
        });

        container.add_event_listener('mouseleave', () => {
            start_auto_scroll();
        });
    }
    container.add_event_listener('scroll', () => {
    if (container.scroll_left >= stop_point) {
        container.scroll_left = 1;
    } 

    else if (container.scroll_left <= 0) {
        container.scroll_left = stop_point - 1; 
    }
})
    container.scroll_left = totalitem_width;
});