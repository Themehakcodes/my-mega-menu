document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('mcmwToggleBtn');
    const dropdown = document.getElementById('mcmwDropdown');

    if (toggleBtn && dropdown) {
        toggleBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        // Optional: Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
});
