document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.filter_btn');
    const cards = document.querySelectorAll('.products_object');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const filterValue = button.getAttribute('data-filter');

            cards.forEach(card => {
                const card_category = card.getAttribute('data-category');

                if (filterValue === 'all' || filterValue.includes(card_category)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });
});