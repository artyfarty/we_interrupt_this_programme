import * as React from "react";
import {useEffect, useState} from "react";
import {INotification} from "./interfaces/INotification";
import axios from "axios";
import * as yup from "yup";
import {Notification} from "./components/Notification";

const
    api = process.env.MIX_ANNOUNCER_APP_API ? process.env.MIX_ANNOUNCER_APP_API : "",
    token = process.env.MIX_ANNOUNCER_APP_TOKEN ? process.env.MIX_ANNOUNCER_APP_TOKEN : "",

    ackMode =process.env.MIX_ANNOUNCER_APP_ACC_MODE === "true",

    pollUrl = ackMode
        ? `${api}/api/poll/${token}/0`
        : `${api}/api/poll/${token}`,

    ackUrl = (id) => `${api}/api/ack/${id}/${token}`,

    fadeDelay = process.env.MIX_ANNOUNCER_APP_FADE_DELAY ? parseInt(process.env.MIX_ANNOUNCER_APP_FADE_DELAY) : 7000,

    pollDelay:number = process.env.MIX_ANNOUNCER_APP_POLL_DELAY ? parseInt(process.env.MIX_ANNOUNCER_APP_POLL_DELAY) : 500;

const pollSchema = yup.object().shape({
    type: yup.string().required(),
    caption: yup.string().required(),
    headline: yup.string().required(),
    text: yup.string().required(),
});

interface AppState {
    notification: null|INotification;
    fade: boolean;
}

const App = () => {
    let pollTimeout: number, fadeTimeout: number, rePollTimeout: number;

    const
        [AppState, setState]:[AppState, Function] = useState({
            notification: null,
            fade: false
        }),

        poll = () => {
            axios.get(pollUrl)
                .then(function (response) {
                    const notification = (response.data.message as INotification);

                    if (response.status === 200 && response.data.message && pollSchema.isValidSync(response.data.message)) {

                        setState({
                            notification: notification,
                            fade: false
                        });

                        fadeTimeout = window.setTimeout(() => {
                            setState({
                                notification: notification,
                                fade: true
                            });

                            if (ackMode) {
                                //если включён ack-режим, то уведомляем об успехе
                                axios.get(ackUrl(notification.id)).catch(e => console.error(e));
                            }

                            //после завершения анимации возобновляем очередь
                            rePollTimeout = window.setTimeout(() => {
                                setState({
                                    notification: null,
                                    fade: false
                                });
                                poll();
                            }, pollDelay + 500);

                        }, notification.duration ? notification.duration : fadeDelay);

                    } else {
                        //повторяем
                        pollTimeout = window.setTimeout(() => poll(), pollDelay);
                    }

                })
                .catch((error) => {
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                    console.log(error.config);

                    pollTimeout = window.setTimeout(() => poll(), pollDelay);
                })
        };

    useEffect(() => {
        poll();

        return () => {
            try {
                clearTimeout(pollTimeout);
                clearTimeout(fadeTimeout);
                clearTimeout(rePollTimeout);
            } catch (e) {
                console.error(e);
            }
        }
    }, []);

    return (
        <div className="container-wrapper">
            <div className="container">
                {AppState.notification ? (
                    <Notification notification={AppState.notification} fade={AppState.fade}/>
                ) : null}
            </div>
        </div>
    );
};

export default App;
