// Animations pour les éléments d'arrière-plan (facultatif, mais ajoute du dynamisme)
document.addEventListener("DOMContentLoaded", () => {
  const heroBgElement1 = document.querySelector("#about .absolute.w-64");
  const heroBgElement2 = document.querySelector("#about .absolute.w-80");

  if (heroBgElement1) {
    heroBgElement1.style.animation = "pulse 6s infinite alternate";
  }
  if (heroBgElement2) {
    heroBgElement2.style.animation = "pulse-slow 8s infinite alternate";
  }

  // Fonction pour initialiser les éléments d'arrière-plan animés pour une section donnée
  function initializeAnimatedBackground(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
      const el1 = section.querySelector(".animated-bg-element-1");
      const el2 = section.querySelector(".animated-bg-element-2");
      if (el1) el1.style.animation = "pulse 6s infinite alternate";
      if (el2) el2.style.animation = "pulse-slow 8s infinite alternate";
    }
  }

  initializeAnimatedBackground("education");
  initializeAnimatedBackground("certificates");
  initializeAnimatedBackground("projects");
  initializeAnimatedBackground("contact");
});

// Logique pour l'effet d'apparition au défilement
const fadeInSections = document.querySelectorAll(".fade-in-section");

const observerOptions = {
  root: null, // Scrolling relative to the viewport
  rootMargin: "0px",
  threshold: 0.1, // Trigger when 10% of the section is visible
};

const sectionObserver = new IntersectionObserver((entries, observer) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("is-visible");
      observer.unobserve(entry.target); // Stop observing once visible
    }
  });
}, observerOptions);

fadeInSections.forEach((section) => {
  sectionObserver.observe(section);
});

window.onload = function () {
  // Obtenir le formulaire et le div de message
  const contactForm = document.getElementById("contactForm");
  const formMessage = document.getElementById("formMessage");

  if (contactForm) {
    contactForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Empêcher la soumission par défaut du formulaire

      // Dans une application réelle, vous enverriez ces données à un serveur backend.
      // Pour la démonstration, nous allons simplement afficher un message.

      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const subject = document.getElementById("subject").value;
      const message = document.getElementById("message").value;

      // Validation de base
      if (!name || !email || !subject || !message) {
        formMessage.textContent = "Veuillez remplir tous les champs.";
        formMessage.className =
          "mt-4 p-3 rounded-lg text-sm bg-red-100 text-red-700 block";
        return;
      }

      // Simuler l'envoi d'e-mail (remplacer par un appel fetch réel vers le backend)
      console.log("Envoi du message :", { name, email, subject, message });

      // Afficher un message de succès
      formMessage.textContent =
        "Merci pour votre message ! Je vous répondrai bientôt.";
      formMessage.className =
        "mt-4 p-3 rounded-lg text-sm bg-green-100 text-green-700 block";

      // Effacer le formulaire après un court délai
      setTimeout(() => {
        contactForm.reset();
        formMessage.textContent = "";
        formMessage.className = "mt-4 p-3 rounded-lg text-sm hidden";
      }, 3000);
    });
  }

  // Logique du curseur de projets
  const slider = document.getElementById("projectsSlider");
  const prevButton = document.getElementById("prevProject");
  const nextButton = document.getElementById("nextProject");

  let isDown = false;
  let startX;
  let scrollLeft;

  // Événements de souris pour le glisser-déposer
  slider.addEventListener("mousedown", (e) => {
    isDown = true;
    slider.classList.add("dragging");
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });

  slider.addEventListener("mouseleave", () => {
    isDown = false;
    slider.classList.remove("dragging");
  });

  slider.addEventListener("mouseup", () => {
    isDown = false;
    slider.classList.remove("dragging");
  });

  slider.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 0.8; // Reduced factor for smoother drag
    slider.scrollLeft = scrollLeft - walk;
  });

  // Événements tactiles pour le glisser-déposer sur mobile
  slider.addEventListener("touchstart", (e) => {
    isDown = true;
    slider.classList.add("dragging");
    startX = e.touches[0].pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
    // e.preventDefault(); // Prevent default touch behavior (e.g., scrolling document), but allow native vertical scroll
  });

  slider.addEventListener("touchend", () => {
    isDown = false;
    slider.classList.remove("dragging");
  });

  slider.addEventListener("touchmove", (e) => {
    if (!isDown) return;
    // e.preventDefault(); // Prevent default touch behavior (e.g., scrolling document), but allow native vertical scroll
    const x = e.touches[0].pageX - slider.offsetLeft;
    const walk = (x - startX) * 0.8; // Reduced factor for smoother drag
    slider.scrollLeft = scrollLeft - walk;
  });
  // Fonctionnalité des boutons fléchés
  const scrollAmount = 300; // Adjust how much to scroll per click

  prevButton.addEventListener("click", () => {
    slider.scrollBy({
      left: -scrollAmount,
      behavior: "smooth",
    });
  });

  nextButton.addEventListener("click", () => {
    slider.scrollBy({
      left: scrollAmount,
      behavior: "smooth",
    });
  });
};
