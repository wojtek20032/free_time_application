var modal = document.getElementById("myModal");

var btns = document.querySelectorAll(".ModalBtn");

var span = document.getElementsByClassName("close")[0];

var data_display = document.querySelectorAll("#data");
var event_display = document.querySelectorAll("#event");
let dataGlobal;
let temp_data;
let end;
const getData = async () => {
  const response = await fetch("../calendar/get_events.php");
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
  let container_to_append = document.getElementsByClassName("row");
  let main_container_for_reminder = document.createElement("div");
  main_container_for_reminder.classList.add("col-12 col-xxl-4 mb-5");
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
  link_first.classList.add("ModalBtn btn btn-primary");
  link_first.innerHTML = "Zobacz wiecej";
  fourth_container_for_reminder.appendChild(link_first);
  third_container_for_reminder.appendChild(h5_first);
  third_container_for_reminder.appendChild(h5_second);
  third_container_for_reminder.container_to_append(fourth_container_for_reminder);
  second_container_for_reminder.appendChild(third_container_for_reminder);
  main_container_for_reminder.appendChild(second_container_for_reminder);
  container_to_append.appendChild(main_container_for_reminder);
});

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
  data_display.forEach(function(data){
    data.innerHTML = "Nieprzydzielona";
  });
  for(let i =0; i < dataGlobal.length;i++){
    let data = new String(dataGlobal[i].date);
    btns[i].setAttribute("id",data);
    data_display[i].innerHTML = data;
    event_display[i].innerHTML = dataGlobal[i].description;
  }
  

  btns.forEach(function(btn){
      let entry_to_display = new String(btn.getAttribute('id'));
      dataGlobal.forEach(entry =>{
        let entry_date = new String(entry.date);
        if(entry_date.localeCompare(entry_to_display)===0){
          let data = new Date();
          let data_to_check = new Date(entry_date + " 00:00:00 GMT+2");
            let date_to_verify = (data_to_check.getTime() - data.getTime())/(1000 * 60 * 60 * 24);
            btn.innerText =  (date_to_verify>=7 ? "Opcjonalne" : ((date_to_verify >3 &&date_to_verify <7) ? "Wazne" : (date_to_verify <=3 ? "Pilne":"none")));
            btn.style.backgroundColor =  (date_to_verify >=7 ? "green" : ((date_to_verify >3 &&date_to_verify <7) ? "#FC7A1E" : (date_to_verify <=3 ? "red":"white")));
        } 
      });
      btn.onclick = function() {
      modal.style.display = "block";
      let entry_to_display = new String(btn.getAttribute('id'));
        let temp = document.getElementById("status"); 
        let note_to_change = document.getElementById("note_to_change"); 
        let text_to_change = document.getElementById("change_text_on_click"),text_to_change1 = document.getElementById("change_of_desc");
        text_to_change.innerText = "Oops, There's no event to display";
        note_to_change.innerText = "Don't worry";
        text_to_change1.innerText = "You will be notified about changes";
        temp.innerText = "";
        dataGlobal.forEach(entry =>{
          let entry_date = new String(entry.date);
          if(entry_date.localeCompare(entry_to_display)===0){
            text_to_change.innerText = entry.description;
            let data = new Date();
            let data_to_check = new Date(entry_date + " 00:00:00 GMT+2");
            let date_to_verify = (data_to_check.getTime() - data.getTime())/(1000 * 60 * 60 * 24);
                text_to_change1.innerText = "Status: ";
                temp.innerText =  (date_to_verify >=7 ? "Opcjonalne" : ((date_to_verify >3 &&date_to_verify <7) ? "Wazne" : (date_to_verify <=3 ? "Pilne":"none")));
                temp.style.color =  (date_to_verify >=7 ? "green" : ((date_to_verify >3 &&date_to_verify <7) ? "#FC7A1E" : (date_to_verify <=3 ? "red":"white")));
                note_to_change.innerText = entry.note;
          }
        });
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
})();

