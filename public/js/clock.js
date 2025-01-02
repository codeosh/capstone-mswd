// public\js\clock.js
function updateClock() {
    const now = new Date();
    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12;
    hours = hours ? hours : 12;

    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString('en-US', options);

    const timeString = `${hours}:${minutes}:${seconds} ${ampm}`;

    document.getElementById(
        'clock'
    ).textContent = `${dateString}  ${timeString}`;
}

setInterval(updateClock, 1000);
updateClock();
