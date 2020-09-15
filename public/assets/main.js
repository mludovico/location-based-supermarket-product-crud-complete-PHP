(function (window, document) {
  'use strict';
  
  function confirmDel(event) {
    event.preventDefault();
    let token = document.getElementsByName('_token')[0].value;
    if(confirm('Deseja realmente remover este item?')){
      let ajax = new XMLHttpRequest();
      ajax.open('DELETE', event.target.parentNode.href);
      ajax.setRequestHeader('X-CSRF-TOKEN', token);
      ajax.onreadystatechange = function () {
        if(ajax.readyState === 4 && ajax.status === 200){
          window.location.href = window.location.pathname;
        }
      };
      ajax.send();
    }else{
      return false;
    }
  }

  if(document.querySelector('.js-del')){
    let btn = document.querySelectorAll('.js-del');
    for(let i = 0; i < btn.length; i++){
      btn[i].addEventListener('click', confirmDel, false);
    }
  }

  function getProducts() {
    let ajax = new XMLHttpRequest();
    let productsData;
    ajax.open('GET', window.location.pathname + '/json', false);
    ajax.onreadystatechange = function () {
      if(ajax.readyState === 4 && ajax.status === 200){
        productsData = JSON.parse(ajax.responseText);
      }
    }
    ajax.send();
    return productsData;
  }

  function getLocations() {
    let ajax = new XMLHttpRequest();
    let LocationsData;
    ajax.open('GET', '/locations/json', false);
    ajax.onreadystatechange = function () {
      if(ajax.readyState === 4 && ajax.status === 200){
        LocationsData = JSON.parse(ajax.responseText);
      }
    }
    ajax.send();
    return LocationsData;
  }

  function updateProductsTable() {
    let table = document.querySelector('table tbody');
    let row;
    let productsData = getProducts();
    let locationsData = getLocations();
    table.innerHTML = '';
    productsData.forEach(item=>{
      let nameCell = document.createElement('td');
      nameCell.scope = 'col';
      nameCell.innerText = item.name;
      let locationCell = document.createElement('td');
      locationCell.scope = 'col';
      let currentLocation = locationsData.filter(lData=>lData.id == item.id_location);
      locationCell.innerText = currentLocation[0].aisle+currentLocation[0].shelf+currentLocation[0].side;
      let editBtn = document.createElement('button');
      editBtn.className = 'btn btn-primary btn-sm pr-3 pl-3';
      editBtn.innerText = 'Editar';
      let editA = document.createElement('a');
      editA.href = 'products/' + item.id + '/edit';
      editA.appendChild(editBtn);
      let removeBtn = document.createElement('button');
      removeBtn.className = 'btn btn-danger btn-sm';
      removeBtn.innerText = 'Remover';
      let removeA = document.createElement('a');
      removeA.href = '/products/' + item.id;
      removeA.className = 'js-del ml-1';
      removeA.appendChild(removeBtn);
      let actioncell = document.createElement('td');
      actioncell.scope = 'col';
      actioncell.appendChild(editA);
      actioncell.appendChild(removeA);
      row = document.createElement('tr');
      row.appendChild(nameCell);
      row.appendChild(locationCell);
      row.appendChild(actioncell);
      table.appendChild(row);
    });
  }

  function updateLocationsTable() {
    let table = document.querySelector('table tbody');
    let row;
    let locationsData = getLocations();
    table.innerHTML = '';
    locationsData.forEach(location=>{
      let aisleCell = document.createElement('td');
      aisleCell.scope = 'col';
      aisleCell.innerText = location.aisle;
      let shelfCell = document.createElement('td');
      shelfCell.scope = 'col';
      shelfCell.innerText = location.shelf;
      let sideCell = document.createElement('td');
      sideCell.scope = 'col';
      sideCell.innerText = location.side;
      let editBtn = document.createElement('button');
      editBtn.className = 'btn btn-primary btn-sm pr-3 pl-3';
      editBtn.innerText = 'Editar';
      let editA = document.createElement('a');
      editA.href = window.location.href + '/' + location.id + '/edit';
      editA.appendChild(editBtn);
      let removeBtn = document.createElement('button');
      removeBtn.className = 'btn btn-danger btn-sm';
      removeBtn.innerText = 'Remover';
      let removeA = document.createElement('a');
      removeA.href = window.location.href + '/' + location.id;
      removeA.className = 'js-del ml-1';
      removeA.appendChild(removeBtn);
      let actioncell = document.createElement('td');
      actioncell.scope = 'col';
      actioncell.appendChild(editA);
      actioncell.appendChild(removeA);
      row = document.createElement('tr');
      row.appendChild(aisleCell);
      row.appendChild(shelfCell);
      row.appendChild(sideCell);
      row.appendChild(actioncell);
      table.appendChild(row);
    });
  }

  if(document.querySelector('.table')){
    if(window.location.pathname === '/products')
      setInterval(updateProductsTable, 2000);
    if(window.location.pathname === '/locations')
      setInterval(updateLocationsTable, 2000);
  }
})(window, document);