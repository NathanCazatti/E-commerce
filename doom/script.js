 document.addEventListener('DOMContentLoaded', () => {
            const carrossel = document.querySelector('.carrossel-container');
            const prevBtn = document.getElementById('prev');
            const nextBtn = document.getElementById('next');
            const itemWidth = 282;
            let currentPosition = 0;
            
            prevBtn.addEventListener('click', () => {
                if (currentPosition > 0) {
                    currentPosition--;
                    carrossel.style.transform = `translateX(-${currentPosition * itemWidth}px)`;
                }
            });
            
            nextBtn.addEventListener('click', () => {
                const maxPosition = document.querySelectorAll('.produto').length - 4;
                if (currentPosition < maxPosition) {
                    currentPosition++;
                    carrossel.style.transform = `translateX(-${currentPosition * itemWidth}px)`;
                }
            });
        });