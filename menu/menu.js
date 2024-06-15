const pageAccessedByReload = window.performance
  .getEntriesByType("navigation")
  .map((nav) => nav.type)
  .includes("reload");
var date_display = document.querySelectorAll(".card-title");

const getData = async () => {
  const response = await fetch("../event/get_events.php");
  const data = await response.json();
  dataGlobal = data;
  return data;
};

(async () => {
  await getData();
  for (let i = 0; i < dataGlobal.length; i++) {
    let data = new Date();
    let entry_date = new String(dataGlobal[i].date);
    let data_to_check = new Date(entry_date + " 23:59:59 GMT+2");
    let date_to_verify =
      (data_to_check.getTime() - data.getTime()) / (1000 * 60 * 60 * 24);
    if (date_to_verify < 0) {
      ref = 1;
      fetch("remove_outdated_events.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: "record_to_be_deleted=" + dataGlobal[i].id,
      });
      if (
        document.cookie
          .split("; ")
          .find((row) => row.startsWith("get_notif_once"))
      ) {
        document.cookie =
          "get_notif_once=; expires=Thu, 01 Jan 1970 00:00:00 GMT; SameSite=None; Secure; Path=/free_time_application";
      }
    }
  }
  if (
    document.cookie.split("; ").find((row) => row.startsWith("get_notif_once"))
  ) {
    console.log("cookie set");
  } else {
    console.log("cookie unset");
  }
  await getData();
  do {
    end = 0;
    for (let i = 0; i < dataGlobal.length - 1; i++) {
      let date1 = new String(dataGlobal[i].date);
      let date2 = new String(dataGlobal[i + 1].date);
      if (date1.localeCompare(date2) < 0) {
        temp_data = dataGlobal[i];
        dataGlobal[i] = dataGlobal[i + 1];
        dataGlobal[i + 1] = temp_data;
        end = 1;
      }
    }
  } while (end != 0);
  if (
    !document.cookie.split("; ").find((row) => row.startsWith("get_notif_once"))
  ) {
    window.localStorage.removeItem("cached_notifications");
    let keys = [];
    let j = 0;
    for (let i = 0; i < dataGlobal.length; i++) {
      let data = new Date();
      let entry_date = new String(dataGlobal[i].date);
      let data_to_check = new Date(entry_date + " 23:59:59 GMT+2");
      let date_to_verify =
        (data_to_check.getTime() - data.getTime()) / (1000 * 60 * 60 * 24);
      if (date_to_verify < 7 && dataGlobal[i].participating === 1) {
        let str = new String(dataGlobal[i].date + dataGlobal[i].id);
        keys[j] = str;
        j++;
      }
    }
    window.localStorage.setItem("cached_notifications", JSON.stringify(keys));
    let data = new String(new Date(new Date().getTime() + 1800000));
    document.cookie =
      "get_notif_once=true; expires=" +
      data +
      "; SameSite=None; Secure; Path=/free_time_application";
  }

  for (let i = 0; i < date_display.length; i++) {
    if (i < dataGlobal.length) {
      let temp_string = new String(dataGlobal[i].date);
      date_display[i].innerHTML = temp_string;
    } else date_display[i].innerHTML = "Nieprzydzielona";
  }
})();

let intervalIdLeft;
let currentImageLeft;

function startMovingImageLeft(src, x, y) {
  const imageContainer = document.getElementById("image-container");
  imageContainer.innerHTML = "";
  clearInterval(intervalIdLeft);

  currentImageLeft = document.createElement("img");
  currentImageLeft.src = src;
  currentImageLeft.style.position = "absolute";
  currentImageLeft.style.left = `${x}px`;
  currentImageLeft.style.top = `${y}px`;
  currentImageLeft.style.display = "block";

  imageContainer.appendChild(currentImageLeft);

  const step = 1;

  let direction = 1;

  intervalIdLeft = setInterval(() => {
    y += step * direction;

    if (y >= 90 || y <= 72) {
      direction *= -1;
    }

    currentImageLeft.style.top = `${y}px`;
  }, 25);
}

function stopMovingImageLeft() {
  clearInterval(intervalIdLeft);
  if (currentImageLeft) {
    currentImageLeft.style.display = "none";
  }
}

let intervalIdRight;
let currentImageRight;

function startMovingImageRight(src, x, y) {
  const imageContainer = document.getElementById("image-container");
  imageContainer.innerHTML = "";
  clearInterval(intervalIdRight);

  currentImageRight = document.createElement("img");
  currentImageRight.src = src;
  currentImageRight.style.position = "absolute";
  currentImageRight.style.right = `${x}px`;
  currentImageRight.style.top = `${y}px`;
  currentImageRight.style.display = "block";

  imageContainer.appendChild(currentImageRight);

  const step = 1;

  let direction = 1;

  intervalIdRight = setInterval(() => {
    y += step * direction;

    if (y >= 90 || y <= 72) {
      direction *= -1;
    }

    currentImageRight.style.top = `${y}px`;
  }, 25);
}

function stopMovingImageRight() {
  clearInterval(intervalIdRight);
  if (currentImageRight) {
    currentImageRight.style.display = "none";
  }
}
