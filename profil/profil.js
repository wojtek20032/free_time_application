document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById('toggle-button');
    const changePasswordSection = document.getElementById('change-password-section');
    const modal = document.getElementById('status-modal');
    const modalMessage = document.getElementById('modal-message');
    const closeModalButton = document.getElementById('close-modal');

    toggleButton.addEventListener('click', function () {
        if (changePasswordSection.style.display === 'none') {
            fadeInAndSlideDown(changePasswordSection);
        } else {
            fadeOutAndSlideUp(changePasswordSection);
        }
    });

    closeModalButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    function fadeInAndSlideDown(element) {
        element.style.opacity = '0';
        element.style.display = 'block';
        let height = element.clientHeight;
        element.style.height = '0px';
        element.style.overflow = 'hidden';

        setTimeout(function () {
            element.style.transition = 'opacity 0.5s, height 0.5s';
            element.style.opacity = '1';
            element.style.height = height + 20 + 'px';
        }, 10);
    }

    function fadeOutAndSlideUp(element) {
        let height = element.clientHeight;

        element.style.transition = 'opacity 0.5s, height 0.5s';
        element.style.opacity = '0';
        element.style.height = '0px';
        element.style.overflow = 'hidden';

        setTimeout(function () {
            element.style.display = 'none';
            element.style.height = height + 'px';
        }, 500);
    }

    function showModal(message) {
        modalMessage.textContent = message;
        modal.style.display = 'block';
    }

    const statusMessage = document.getElementById('status-message').textContent;
    if (statusMessage) {
        showModal(statusMessage);
    }
});
