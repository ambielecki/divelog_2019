self.addEventListener('message', function(e) {
    let delay_minutes = 60;

    switch (e.data) {
        case 'begin_pulse':
            if (!self.pulse_initialized) {
                self.pulse_interval_id = setInterval(function(){
                    self.postMessage('pulse');
                }, delay_minutes * 60 * 1000);

                self.pulse_initialized = true;
            }

            break;
    }
}, false);