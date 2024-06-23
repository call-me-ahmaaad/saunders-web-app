document.addEventListener('DOMContentLoaded', () => {
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdown.addEventListener('mouseover', () => {
        dropdownContent.classList.remove('hide');
        dropdownContent.classList.add('show');
    });

    dropdown.addEventListener('mouseout', () => {
        dropdownContent.classList.remove('show');
        dropdownContent.classList.add('hide');
    });
});
