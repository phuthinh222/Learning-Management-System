import { setupNavigationConfirmation } from './auth.js';
import Countdown from './resend-email.js';
import { resendEmail } from './resend-email.js';
setupNavigationConfirmation();
const resendButton = new Countdown('resend-email');

resendButton.startCountdown();

document.getElementById('resend-email').addEventListener('click', () => {
    resendEmail();
    resendButton.startCountdown();

})
