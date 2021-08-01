
export function notify(type, message, { duration = 1000, context = document }) {
    
    $.notify({
        icon: 'flaticon-alarm-1',
        title: message,
        message: '',
    },{
        type: type,
        placement: {
            from: "bottom",
            align: "right"
        },
        time: duration,
    });
    
}

export function info(message, duration) {
    notify('info', message, { duration });
}

export function success(message, duration) {
    notify('success', message, { duration });
}

export function warning(message, duration) {
    notify('warning', message, { duration });
}

export function error(message, duration) {
    notify('error', message, { duration });
}

