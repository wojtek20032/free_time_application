var date_display = document.querySelectorAll(".card-title");

const getData = async () => {
    const response = await fetch("../calendar/get_events.php");
    const data = await response.json();
    dataGlobal = data;
    return data;
  };

  (async () => {
    await getData();
    let data = new Date();
    for(let i =0; i< dataGlobal.length;i++){
      let entry_date = new String(dataGlobal[i].date);
      let data_to_check = new Date(entry_date + " 23:59:59 GMT+2");
      let date_to_verify = (data_to_check.getTime() - data.getTime())/(1000 * 60 * 60 * 24);
      console.log(date_to_verify);
      if(date_to_verify <0){
        fetch("remove_outdated_events.php",{
          method: "POST",
          headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
  },
  body: "record_to_be_deleted=" + dataGlobal[i].id
        });
      }
    }
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