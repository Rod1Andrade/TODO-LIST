function createNewTask()
{
    console.log('button clicked')   
    const containerTask = document.getElementById('container-newTask')
    containerTask.style.display = 'block'

    document.getElementById('header').style.display = 'none'
    document.getElementById('main-section').style.display = 'none'
}

function hiddenDiv()
{
    console.log('hello from hidden div')
    const containerTask = document.getElementById('container-newTask')
    containerTask.style.display = 'none'
    document.getElementById('header').style.display = 'flex'
    document.getElementById('main-section').style.display = 'flex'
}
