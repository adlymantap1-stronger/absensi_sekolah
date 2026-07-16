import './bootstrap';

document.addEventListener('livewire:navigated', () => {
    const dark = localStorage.getItem('darkMode') === 'true';
    document.documentElement.classList.toggle('dark', dark);
});