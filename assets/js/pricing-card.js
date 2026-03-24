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
                    var newLabel = isChecked
                        ? (label.getAttribute('data-hourly-label') || labelText)
                        : (label.getAttribute('data-monthly-label') || labelText);
                    label.textContent = newLabel;
                    input.setAttribute('aria-label', 'Pricing: ' + newLabel + ' selected');
                }

                equalizeCards();
            }

            input.addEventListener('change', applyState);
        });
    }

    function equalizeCards() {
        var rows = document.querySelectorAll('.elementor-widget-yt_pricing_card');
        if (!rows.length) {
            rows = document.querySelectorAll('.elementor-widget');
        }

        var processed = [];
        rows.forEach(function (row) {
            var card = row.querySelector('.yt-pricing-card');
            if (!card) return;

            var prev = processed.length ? processed[processed.length - 1] : null;
            if (prev && Math.abs(prev.el.getBoundingClientRect().top - card.getBoundingClientRect().top) < 5) {
                prev.group.push(card);
            } else {
                processed.push({ el: card, group: [card] });
            }
        });

        processed.forEach(function (item) {
            if (item.group.length < 2) return;

            item.group.forEach(function (card) {
                card.style.minHeight = '0';
                card.style.height = 'auto';
            });

            var maxH = 0;
            item.group.forEach(function (card) {
                var h = card.offsetHeight;
                if (h > maxH) maxH = h;
            });

            item.group.forEach(function (card) {
                card.style.minHeight = maxH + 'px';
            });
        });
    }

    function initAll() {
        document.querySelectorAll('.yt-pricing-card').forEach(function (card) {
            initPricingCards(card);
        });
        equalizeCards();
    }

    if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/yt_pricing_card',
            function ($scope) {
                initPricingCards($scope[0]);
                setTimeout(equalizeCards, 50);
            }
        );
    }

    document.addEventListener('DOMContentLoaded', function () {
        initAll();
        window.addEventListener('load', equalizeCards);
        window.addEventListener('resize', equalizeCards);
    });
})();
