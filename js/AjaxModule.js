function deleteAjax(context, idTask)
{

    // Objeto de REQUEST
    const request = new XMLHttpRequest

    request.onreadystatechange = function()
    {
        if(this.status == 200 && this.readyState == 4)
        {
            console.log('ID TASK:', this.responseText)
            getComponentById(idTask)
        }
    }

    request.open('GET', `/TODO-LIST/php/controller/TaskController.php?delete=${idTask}`, true)
    request.send()

}

function concluirAjax(context, idTask)
{
    // Objeto de REQUEST
    const request = new XMLHttpRequest

    request.onreadystatechange = function()
    {
        if(this.status == 200 && this.readyState == 4)
        {
            getComponentById(idTask)
        }
    }

    request.open('GET', `/TODO-LIST/php/controller/TaskController.php?concluir=${idTask}`, true)
    request.send()

}

function updateTitle(context, idTask)
    {
    // Objeto de REQUEST
    const request = new XMLHttpRequest

    request.onreadystatechange = function()
    {
        if(this.status == 200 && this.readyState == 4)
        {
            console.log(this.responseText)
        }
    }

    const value = document.getElementById(`text-${idTask}`).innerHTML

    request.open('GET', `/TODO-LIST/php/controller/TaskController.php?id=${idTask}&updateTitle=${value}`, true)
    request.send()
}

function updateDesc(context, idTask)
    {
    // Objeto de REQUEST
    const request = new XMLHttpRequest

    request.onreadystatechange = function()
    {
        if(this.status == 200 && this.readyState == 4)
        {
            console.log(this.responseText)
        }
    }

    const value = document.getElementById(`desc-${idTask}`).innerHTML

    request.open('GET', `/TODO-LIST/php/controller/TaskController.php?id=${idTask}&updateDesc=${value}`, true)
    request.send()
}


function getComponentById(id)
{
    const elemt = document.getElementById(id)
    elemt.style.display = 'none'
}