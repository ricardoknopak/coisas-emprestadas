function signup( event, name, username, password, password_chk, email ) {
    event.preventDefault()
    if (password != password_chk) {
      alert("A confirmação da senha é diferente da senha digitada")
      return false
    }
    let data = new FormData()
    data.append('name', name)
    date.append('username', username)
    date.append('password', password)
    date.append('email', email)
    date.append('action', 'singup')
    fetch('./actions.php', {
      method: 'POST',
      body: data
    })
    .then(response => response.json())
    .then(res => {
      location.reload();
      return true
    })
}

function devolver(usuario, coisa) {
  let data = new FormData()
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

function adicionar() {
  let data = new FormData()
  data.append('actions', 'ADICIONAR')
  data.append('nome', document.querySelector("#novo_nome").value)
  data.append('descricao', document.querySelector("#nova_descricao").value)
  data.append('id_usuario', document.querySelector("#novo_proprietario").value)

  fetch('../actions.php', {
    method: 'POST',
    body: data
  })
  .then(response => response.json())
  .then(res => {
    console.log(res.message);
    modal(false)
    alert("Alguma Coisa criada com sucesso!")
    location.reload();
    return true
  })
  .catch(err => console.log(err))
}

function modal(action) {
  let addCoisas = document.querySelector("#addCoisas")
  if (action) {
    addCoisas.style.display = "block"
  }
  if (!action) {
    addCoisas.style.display = "none"
  }
}

function logout( ) {
  debugger
  let data = new FormData()
  data.append('actions', 'logout')
  fetch('../actions.php', {
    method: 'POST',
    body: data
  })
  .then(response => response.json())
  .then(res => {
    console.log(res.message);
    window.location.href = "./index.php"
    return true
  })
  .catch(err => console.log(err))
}