document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('mcmwToggleBtn');
    const dropdown = document.getElementById('mcmwDropdown');

    if (toggleBtn && dropdown) {
        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
});
