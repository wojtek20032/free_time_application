var date_display = document.querySelectorAll(".card-title");

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
    for(let i =0; i < date_display.length;i++){
        if(i < dataGlobal.length){
        let temp_string = new String(dataGlobal[i].date);
         date_display[i].innerHTML = temp_string;
        }else date_display[i].innerHTML = "Nieprzydzielona";
    }
  })();