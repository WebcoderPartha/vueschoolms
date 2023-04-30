class Notification {


    success(message){
        Toast.fire({
            icon: 'success',
            title: message
        })
    }

    error(message){
        Toast.fire({
            icon: 'error',
            title: message
        })
    }

    warning(message){
        Toast.fire({
            icon: 'warning',
            title: message
        })
    }

    info(message){
        Toast.fire({
            icon: 'info',
            title: message
        })
    }

    question(message){
        Toast.fire({
            icon: 'question',
            title: message
        })
    }




}

export  default Notification = new Notification();