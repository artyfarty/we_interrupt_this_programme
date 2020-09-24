export interface INotificationSimple {
    id: number;
    type: string;
    caption: string;
    headline: string;
    text: string;
}

export interface INotificationUrgent extends INotificationSimple {
    type: "urgent";
    text: string;
}

export interface INotificationSchedule extends INotificationSimple {
    type: "schedule";
    event_time?: string; //"19:00"
}

export interface INotificationDonation extends INotificationSimple {
    type: "donation";
}

export interface INotificationList extends INotificationSimple {
    type: "list";
    lines: string[];
}

export type INotification = INotificationSimple | INotificationUrgent | INotificationSchedule | INotificationDonation | INotificationList;
