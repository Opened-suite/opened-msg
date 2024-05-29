let toggleUsersButton = document.querySelector("button#toggleusers")



toggleUsersButton.onclick = () => {
    document.querySelector(".users").classList.remove("hidden")
}
document.addEventListener('DOMContentLoaded', () => {
    const percentElement = document.querySelector('.percent span');
    let currentPercent = 20;
  
    const animateTo100 = () => {
      currentPercent += 1;
      percentElement.textContent = `${currentPercent}%`;
  
      if (currentPercent < 100) {
        requestAnimationFrame(animateTo100);
      }
    };
  
    requestAnimationFrame(animateTo100);
  });


