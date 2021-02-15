// This file can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

export default {
    production: false,
    BASE_URL: process.env.VUE_APP_API_BASE_ENDPOINT,
    API_URL: process.env.VUE_APP_API_ENDPOINT,
    oauth: {
        "grant_type": "client_credentials",
        "client_id": "1",
        "client_secret": "TzOt7vgzJZqlxVLO3mN1qXxK0BIS8IacOOjIGPV9"
    }
};
