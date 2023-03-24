//print invoice function
function printRecipt(){
  window.print();
  
}

const productCard = document.querySelectorAll('.productCard');
const productName=document.querySelectorAll('.productName');
const productPrice=document.querySelectorAll('.productPrice');
const tableWhite=document.querySelector('.tableInvoice');
const confirmOrder = document.querySelector('#confirm');

//find total payment and
//add to invoice
var total=document.querySelector('.total');
var totalPrice;
let isTotal = false;

for(let i=0;i<productCard.length;i++){

    productCard[i].addEventListener('click',()=>{
      
      //change background of the selected cards
      productCard[i].style.backgroundColor="rgb(209,231,221)";
     
      if(parseInt(productCard[i].id)!=i){
        addToInvoice(i); 
      }
    });
          
}

//to calculate total automatically
for(let i=0;i<productCard.length;i++){

  window.onchange = () =>{
      addToInvoice(i,true);
  }

}


function addToInvoice(i,findtotal=false){

    //add new item to invoice
    if(!findtotal){
      productCard[i].setAttribute('id',i);
      let tr = document.createElement('tr');
      tr.innerHTML = '<td class="itemName"></td><td><input class="itemQty text-center border-0 outline-0" style="width:40px" type="number" value=1 min="0"/></td><td class="itemPrice">0</td>';
      tableWhite.appendChild(tr);
  
    }

    var itemQty=document.querySelectorAll('.itemQty');
    var itemName=document.querySelectorAll('.itemName');
    var itemPrice=document.querySelectorAll('.itemPrice');

    if(!findtotal){
      itemName[itemName.length-1].innerHTML = productName[i].innerHTML;
      itemPrice[itemName.length-1].innerHTML = productPrice[i].innerHTML;
    }

    //extend height of right side invoice
    if(itemName.length > 6){
      var prtContent = document.getElementById("content");
      prtContent.style.height='100%';
    }
   
    //find total
    totalPrice=0;
    let index;
    for(let i=0;i<itemName.length;i++){
      totalPrice+= parseInt(itemPrice[i].innerHTML) * itemQty[i].value ;
      index=i;
    }
    total.innerHTML = totalPrice +  " ៛ ";
    
    //delete item with 0 qty
    for(let k=0;k<itemQty.length;k++){
      
      if(itemQty[k].value==0){

        for(let m=0;m<productCard.length;m++){
          if(itemName[k].innerHTML == productName[m].innerHTML){
            productCard[m].removeAttribute('id');
            productCard[m].style.backgroundColor="white";
          }
        }

        itemName[k].parentElement.remove();
      }
    }

    //display No items message
    const noItem = document.querySelector('.noItem');

    if(itemName.length!=0){
      noItem.style.display='none';
    }else{
      noItem.style.display='';
    }

}


//find change
const totalKh= document.querySelector('#cash-total-kh');
const totalUs= document.querySelector('#cash-total-us');
const chnageUs= document.querySelector('#cash-change-us');
const chnageKh= document.querySelector('#cash-change-kh');
const inputCash= document.querySelector('#costomer-cash');
const riel= document.querySelector('#riel');
const dollar= document.querySelector('#dollar');
const currency= document.querySelector('#currency');

const EXCHANGE_RATE = 4000;

currency.innerHTML=" ៛ ";

riel.onclick=()=>{

  currency.innerHTML=" ៛ ";
  change();
}

dollar.onclick=()=>{

  currency.innerHTML=" $ ";
  change();

}

function findChange(change){

    totalKh.innerHTML="Total in Riel: " + total.innerHTML;

    if(!isNaN(parseInt(total.innerHTML))){
  
      totalUs.innerHTML=`Total in US: ${parseInt(total.innerHTML)/EXCHANGE_RATE} $` ;
  
    }else{
  
      totalUs.innerHTML=`Total in US: 0 $` ;
  
    }

    change();

}

function change(){

  if(parseInt(total.innerHTML)!=0){

    if(inputCash.value!=0){

        if(currency.innerHTML === " ៛ "){

          if(inputCash.value < parseInt(total.innerHTML)){

            chnageKh.innerHTML= `Not Enough Money. ${parseInt(total.innerHTML) - inputCash.value}៛ more!`;
            chnageUs.innerHTML= `Not Enough Money. ${(parseInt(total.innerHTML) - inputCash.value) / EXCHANGE_RATE}$ more!`;
      
          }else{
      
            chnageKh.innerHTML= `Change(៛): ${inputCash.value - parseInt(total.innerHTML)} ៛`;
            chnageUs.innerHTML= `Change($): ${(inputCash.value - parseInt(total.innerHTML)) / EXCHANGE_RATE} $`;
      
          }

        }else{

          if(inputCash.value < parseInt(total.innerHTML)/EXCHANGE_RATE){

            chnageKh.innerHTML= `Not Enough Money. ${parseInt(total.innerHTML) - inputCash.value*EXCHANGE_RATE}៛ more!`;
            chnageUs.innerHTML= `Not Enough Money. ${(parseInt(total.innerHTML)/EXCHANGE_RATE - inputCash.value)}$ more!`;
      
          }else{
      
            chnageKh.innerHTML= `Change(៛): ${inputCash.value * EXCHANGE_RATE - parseInt(total.innerHTML)} ៛`;
            chnageUs.innerHTML= `Change($): ${inputCash.value - parseInt(total.innerHTML)/EXCHANGE_RATE} $`;
      
          }

        }

    }else{

      chnageKh.innerHTML= `Please input costomer's cash to find change!`;
      chnageUs.innerHTML='';
    }

  }else{

    chnageKh.innerHTML= `You have not bought anything yet!`;

  }
  
}


