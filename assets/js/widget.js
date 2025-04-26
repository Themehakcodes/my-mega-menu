document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.mcmw-menu li.menu-item-has-children > a').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const submenu = this.parentElement.querySelector('ul');
            if (submenu) submenu.classList.toggle('open');
        });
    });
});
