const themeSwitch = document.getElementById("themeSwitch");
const lightIcon = document.getElementById("lightIcon");
const darkIcon = document.getElementById("darkIcon");

function toggleTheme() {
  const currentTheme = document.body.classList.contains("dark-theme")
    ? "dark"
    : "light";
  const newTheme = currentTheme === "dark" ? "light" : "dark";

  document.body.classList.toggle("dark-theme");
  lightIcon.style.display = newTheme === "light" ? "inline" : "none";
  darkIcon.style.display = newTheme === "dark" ? "inline" : "none";

  const activeIcon = newTheme === "light" ? lightIcon : darkIcon;
  activeIcon.classList.add("animate");
  setTimeout(() => activeIcon.classList.remove("animate"), 300);

  localStorage.setItem("theme", newTheme);
}

themeSwitch.addEventListener("click", toggleTheme);

const savedTheme = localStorage.getItem("theme") || "light";
if (savedTheme === "dark") {
  document.body.classList.add("dark-theme");
  lightIcon.style.display = "none";
  darkIcon.style.display = "inline";
}
