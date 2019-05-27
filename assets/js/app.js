require('../css/app.css');
const $ = require('jquery');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.


class TaskForm {
  constructor (formSelector) {
    this._form = formSelector
  }


  returnForm(){
    return this._inputUser
  }

  submitForm() {

    $(this._form ).submit((e) => {
      e.preventDefault()
      $.post('/addtask', 'task=' +this._form.find('input').val(), (res) =>{
        console.log(res)
      })

    })
  }
}

const form = new TaskForm($('.form'))

form.submitForm()