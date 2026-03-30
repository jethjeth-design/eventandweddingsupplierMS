document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggles = document.querySelectorAll('.nav-dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.closest('.nav-dropdown');
            dropdown.classList.toggle('open');
        });
    });
});
