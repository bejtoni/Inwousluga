document.addEventListener("DOMContentLoaded", function () {
  var categorySelect = document.getElementById("select-category");
  var serviceSelect = document.getElementById("select-service");

  if (categorySelect && serviceSelect) {
    categorySelect.addEventListener("change", function () {
      var categoryID = this.value;

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../php/fetch-services.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            try {
              var services = JSON.parse(xhr.responseText);
              serviceSelect.innerHTML = "";

              services.forEach(function (service) {
                var option = document.createElement("option");
                option.value = service.SID;
                option.textContent = service.Service_Name;
                serviceSelect.appendChild(option);
              });
            } catch (error) {
              console.error("Failed to parse JSON response:", error);
            }
          } else {
            console.error("Request failed with status:", xhr.status);
          }
        }
      };
      xhr.onerror = function () {
        console.error("Request failed due to a network error");
      };
      xhr.send("categoryID=" + categoryID);
    });
  } else {
    console.error("Category or service select element not found");
  }
});

console.log("muzafer");

const tabsBox = document.querySelector(".tabs-box");

const allTabs = tabsBox?.querySelectorAll(".tab");
const arrowIcons = document.querySelectorAll(".tab-icon i");

let isDragging = false;
const handleIcons = (scrollVal) => {
  let maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
  arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
  arrowIcons[1].parentElement.style.display =
    maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
};
arrowIcons.forEach((icon) => {
  icon.addEventListener("click", () => {
    // if clicked icon is left, reduce 350 from tabsBox scrollLeft else add
    let scrollWidth = (tabsBox.scrollLeft += icon.id === "left" ? -340 : 340);
    handleIcons(scrollWidth);
  });
});
allTabs?.forEach((tab) => {
  tab.addEventListener("click", () => {
    tabsBox.querySelector(".active").classList.remove("active");
    tab.classList.add("active");
  });
});
const dragging = (e) => {
  if (!isDragging) return;
  tabsBox.classList.add("dragging");
  tabsBox.scrollLeft -= e.movementX;
  handleIcons(tabsBox.scrollLeft);
};
const dragStop = () => {
  isDragging = false;
  tabsBox?.classList.remove("dragging");
};
tabsBox?.addEventListener("mousedown", () => (isDragging = true));
tabsBox?.addEventListener("mousemove", dragging);
document?.addEventListener("mouseup", dragStop);

document.querySelector(".current-date").textContent =
  new Date().toLocaleDateString(undefined, {});
