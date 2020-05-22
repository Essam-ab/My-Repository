window.onload = function () {
    const el = document.querySelector('.wrapper_chat_messages ');
    const resizers = document.querySelectorAll('.resizer');
    var currentResizer;

    for (let resizer of resizers) {
        resizer.addEventListener('mousedown', mousedown);

        function mousedown(e) {
            currentResizer = e.target;
            isResizing = true;

            let prevX = e.clientX;
            let prevY = e.clientY;

            window.addEventListener('mousemove', mousemove);
            window.addEventListener('mouseup', mouseup);

            function mousemove(e) {
                return; //just remove this return if you want to use this function
                const rect = el.getBoundingClientRect();

                if (currentResizer.classList.contains('se')) {
                    el.style.width = rect.width - (prevX - e.clientX) + "px";
                    el.style.height = rect.height - (prevY - e.clientY) + "px";
                } else if (currentResizer.classList.contains('sw')) {
                    el.style.width = rect.width + (prevX - e.clientX) + "px";
                    el.style.height = rect.height + (prevY - e.clientY) + "px";
                    el.style.left = rect.left - (prevX - e.clientX) + "px";
                } else if (currentResizer.classList.contains('ne')) {
                    el.style.width = rect.width - (prevX - e.clientX) + "px";
                    el.style.height = rect.height + (prevY - e.clientY) + "px";
                    el.style.top = rect.top - (prevY - e.clientY) + "px";
                } else {
                    if (rect.height + (prevY - e.clientY) > 400 &&
                        rect.width + (prevX - e.clientX) > 390) {
                        prevDragHeight = rect.width + (prevX - e.clientX);
                        el.style.width = rect.width + (prevX - e.clientX) + "px";
                        el.style.height = rect.height + (prevY - e.clientY) + "px";
                        el.style.top = rect.top - (prevY - e.clientY) + "px";
                        el.style.left = rect.left - (prevX - e.clientX) + "px";
                    }
                }
                prevX = e.clientX;
                prevY = e.clientY;
            }

            function mouseup() {
                return; //just remove this return if you want to use this function
                window.removeEventListener('mousemove', mousemove);
                window.removeEventListener('mouseup', mouseup);
            }
        }
    }

}