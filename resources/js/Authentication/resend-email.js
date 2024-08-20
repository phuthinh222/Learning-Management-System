export default class Countdown {
    constructor(buttonId, countdownDuration = 60) {
        this.button = document.getElementById(buttonId);
        this.countdownDuration = countdownDuration;
        this.timer = null;
    }

    startCountdown() {
        let timeLeft = this.countdownDuration;

        this.button.disabled = true;
        this.button.value = `Gửi lại mã (${timeLeft}s)`;

        this.timer = setInterval(() => {
            timeLeft--;

            if (timeLeft > 0) {
                this.button.value = `Gửi lại mã (${timeLeft}s)`;
                this.button.style.backgroundColor = '#ccc';
            } else {
                clearInterval(this.timer);
                this.button.disabled = false;
                this.button.value = 'Gửi lại mã';
                this.button.style.backgroundColor = '#63b9db';
            }
        }, 1000);
    }
}
export function resendEmail(email_address) {
    fetch('/verify/resendEmail').then((response) => response.json())
    .then((data) => {
        alert(data.message);
    })
}