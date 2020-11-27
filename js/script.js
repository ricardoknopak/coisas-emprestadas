function devolver(usuario, coisa) {
  let data = new FormData()
  console.log('Params:', usuario, coisa)
  data.append('actions', 'DEVOLVER')
  data.append('usuario_id', usuario)
  data.append('id_coisa', coisa)
    
  fetch("../actions.php", {
    method: 'POST',
    body: data
  })
  .then(response => response.json())
  .then(res => {
    console.log(res.message);
    location.reload();
    return true
  })
  .catch(err => console.log(err))
}

function emprestar(usuario, coisa) {
  let data = new FormData()
  data.append('actions', 'EMPRESTAR')
  data.append('usuario_id', usuario)
  data.append('id_coisa', coisa)
    
  fetch("../actions.php", {
    method: 'POST',
    body: data
  })
  .then(response => response.json())
  .then(res => {
    console.log(res.message);
    location.reload();
    return true
  })
  .catch(err => console.log(err))
}