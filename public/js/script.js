window.addEventListener('load', () => {
  const cards = document.querySelectorAll('.product-card');
  cards.forEach((card, i) => {
    setTimeout(() => {
      card.classList.add('show');
    }, i * 120);
  });
});