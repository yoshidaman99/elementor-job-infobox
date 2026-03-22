(function () {
    'use strict';

    function initPricingCards(scope) {
        var toggleInputs = scope.querySelectorAll('.yt-pricing-toggle-input');

        toggleInputs.forEach(function (input) {
            if (input.hasAttribute('data-ytBound')) {
                return;
            }
            input.setAttribute('data-ytBound', 'true');

            var card = input.closest('.yt-pricing-card');
            if (!card) {
                return;
            }

            var hourlyDisplay = card.querySelector('.yt-price-hourly');
            var monthlyDisplay = card.querySelector('.yt-price-monthly');
            var label = card.querySelector('.yt-pricing-toggle-label');
            var labelText = '';

            if (label) {
                labelText = label.getAttribute('data-hourly-label') || label.textContent || '';
            }

            function applyState() {
                var isChecked = input.checked;

                if (hourlyDisplay) {
                    hourlyDisplay.style.display = isChecked ? 'flex' : 'none';
                }
                if (monthlyDisplay) {
                    monthlyDisplay.style.display = isChecked ? 'none' : 'flex';
                }
                if (label && labelText) {
                    label.textContent = isChecked
                        ? (label.getAttribute('data-hourly-label') || labelText)
                        : (label.getAttribute('data-monthly-label') || labelText);
                }
            }

            input.addEventListener('change', applyState);

            applyState();
        });
    }

    if (typeof elementorFrontend !== 'undefined') {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/yt_pricing_card/widget',
            function ($scope) {
                initPricingCards($scope[0]);
            }
        );
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.yt-pricing-card').forEach(function (card) {
            initPricingCards(card);
        });
    });
})();
