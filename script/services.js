

let loadMoreBtn = document.querySelector('.services .load-more .btn');
        let currentItem = 3;

        loadMoreBtn.onclick = () =>{
            let boxes = [...document.querySelectorAll('.services .box-container .box')];
            for (var i = currentItem; i < currentItem + 3; i++){
                boxes [i].style.display = 'inline-block';
            };
            currentItem += 3;
            if ( currentItem >= boxes.length){
                loadMoreBtn.style.display = 'none';
            }
        }