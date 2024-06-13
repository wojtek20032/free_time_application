


var modal = document.getElementById("myModal");

var btns;

var span = document.getElementsByClassName("close")[0];

var data_display = document.querySelectorAll("#data");
var event_display = document.querySelectorAll("#event");
let temp_data;
let end;
let dataGlobal;
const getData = async () => {
  const response = await fetch("../event/get_events.php");
  const data = await response.json();
  dataGlobal = data;
  return data;
};

(async () => {
  await getData();
  do{
    end = 0;
    for(let i =0; i< dataGlobal.length-1; i++){
      let date1 = new String(dataGlobal[i].date);
      let date2 = new String(dataGlobal[i+1].date);
      if(date1.localeCompare(date2)<0){
        temp_data = dataGlobal[i];
        dataGlobal[i] = dataGlobal[i+1];
        dataGlobal[i+1] = temp_data;
         end = 1;
      }
    }
  } while(end!=0);
  for(let i =0; i < dataGlobal.length;i++){
    let entry_date = new String(dataGlobal[i].date);
    let data = new Date();
    let data_to_check = new Date(entry_date + " 23:59:59 GMT+2");
    let date_to_verify = (data_to_check.getTime() - data.getTime())/(1000 * 60 * 60 * 24);
    if(date_to_verify<7 && dataGlobal[i].participating ===1){
    let container_to_append = document.getElementsByClassName("row");
    let main_container_for_reminder = document.createElement("div");
    main_container_for_reminder.classList.add("col-12", "col-xxl-4", "mb-5");
    main_container_for_reminder.id = "card-inner";
    let second_container_for_reminder = document.createElement("div");
    second_container_for_reminder.classList.add("card");
    let third_container_for_reminder = document.createElement("div");
    third_container_for_reminder.classList.add("card-body");
    let h5_first = document.createElement("h5");
    h5_first.classList.add("card-title");
    h5_first.id = "data";
    let h5_second = document.createElement("h5");
    h5_second.classList.add("card-title");
    h5_second.id = "event";
    let fourth_container_for_reminder = document.createElement("div");
    fourth_container_for_reminder.classList.add("more");
    let link_first = document.createElement("a");
    link_first.classList.add("ModalBtn", "btn", "btn-primary");
    link_first.innerHTML = "Zobacz wiecej";
    fourth_container_for_reminder.appendChild(link_first);
    third_container_for_reminder.appendChild(h5_first);
    third_container_for_reminder.appendChild(h5_second);
    third_container_for_reminder.appendChild(fourth_container_for_reminder);
    second_container_for_reminder.appendChild(third_container_for_reminder);
    main_container_for_reminder.appendChild(second_container_for_reminder);
    container_to_append[0].appendChild(main_container_for_reminder);
    }
  }
  btns = document.querySelectorAll(".ModalBtn");
  data_display = document.querySelectorAll("#data");
  event_display = document.querySelectorAll("#event");
  data_display.forEach(function(data){
    data.innerHTML = "Nieprzydzielona";
  });
  let j =0;
  for(let i =0; i < dataGlobal.length;i++){
    let entry_date = new String(dataGlobal[i].date);
    let data = new Date();
    let data_string = new String(dataGlobal[i].date);
    let data_to_check = new Date(entry_date + " 23:59:59 GMT+2");
    let date_to_verify = (data_to_check.getTime() - data.getTime())/(1000 * 60 * 60 * 24);
    if(date_to_verify<7 && dataGlobal[i].participating ===1){
    let id = new String(dataGlobal[i].date+dataGlobal[i].id);
    btns[j].id = id;
    data_display[j].innerHTML = data_string;
    event_display[j].innerHTML = dataGlobal[i].description;
    j++;
    }
  }
  btns.forEach(function(btn){
    let entry_to_display = new String(btn.getAttribute('id'));
    console.log(entry_to_display);
    for(let i =0; i < dataGlobal.length; i++){
      let entry_date = new String(dataGlobal[i].date+dataGlobal[i].id);
      console.log(entry_date);
      if(entry_date.localeCompare(entry_to_display)===0){
        let data = new Date();
        let data_to_check = new Date(new String(dataGlobal[i].date) + " 23:59:59 GMT+2");
          let date_to_verify = (data_to_check.getTime() - data.getTime())/(1000 * 60 * 60 * 24);
          btn.innerText =  (date_to_verify>=7 ? "Opcjonalne" : ((date_to_verify >3 &&date_to_verify <7) ? "Wazne" : (date_to_verify <=3 ? "Pilne":"none")));
          btn.style.backgroundColor =  (date_to_verify >=7 ? "green" : ((date_to_verify >3 &&date_to_verify <7) ? "#FC7A1E" : (date_to_verify <=3 ? "red":"white")));
          break;
        } 
    }
    
    btn.onclick = function() {
    let store_notif_table = JSON.parse(window.localStorage.getItem("cached_notifications"));
    modal.style.display = "block";
    let entry_to_display = new String(btn.getAttribute('id'));
      let temp = document.getElementById("status"); 
      let note_to_change = document.getElementById("note_to_change"); 
      let text_to_change = document.getElementById("change_text_on_click"),text_to_change1 = document.getElementById("change_of_desc");
      text_to_change.innerText = "Oops, There's no event to display";
      note_to_change.innerText = "Don't worry";
      text_to_change1.innerText = "You will be notified about changes";
      temp.innerText = "";
      for(let i =0; i < dataGlobal.length; i++){
        let entry_date = new String(dataGlobal[i].date+dataGlobal[i].id);
        if(entry_date.localeCompare(entry_to_display)===0){
          text_to_change.innerText = dataGlobal[i].description;
          let data = new Date();
          let data_to_check = new Date(new String(dataGlobal[i].date) + " 23:59:59 GMT+2");
          let date_to_verify = (data_to_check.getTime() - data.getTime())/(1000 * 60 * 60 * 24);
              text_to_change1.innerText = "Status: ";
              temp.innerText =  (date_to_verify >=7 ? "Opcjonalne" : ((date_to_verify >3 &&date_to_verify <7) ? "Wazne" : (date_to_verify <=3 ? "Pilne":"none")));
              temp.style.color =  (date_to_verify >=7 ? "green" : ((date_to_verify >3 &&date_to_verify <7) ? "#FC7A1E" : (date_to_verify <=3 ? "red":"white")));
              note_to_change.innerText = dataGlobal[i].note;

          for(let x = 0;x < store_notif_table.length; x++){
            if(entry_date.localeCompare(store_notif_table[x])===0){
            store_notif_table.splice(x,1);
            console.log(store_notif_table);
          }
        }
        break;
      }
    }
    window.localStorage.setItem("cached_notifications",JSON.stringify(store_notif_table));
  }
});
span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
console.log(window.localStorage);
if(document.cookie.split("; ").find((row) => row.startsWith("get_notif_once"))){
    console.log("cookie set");
}
else{
  console.log("cookie unset");
}
})();

