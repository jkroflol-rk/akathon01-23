const deleteButtons = document.querySelectorAll('.delete-button');
const cards = document.querySelectorAll('.card');

deleteButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    const card = cards[index];
    card.classList.add('removing');

    setTimeout(() => {
      card.remove();
    }, 500);
  });
});
