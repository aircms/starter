import {wait} from "./module/wait";
import {nav} from "./module/nav";

nav.callback.push(() => init());
nav.beforeCallback.push(() => {
  console.log("Before callback");
});

nav.watch();
wait.watch();

const init = () => {
  console.log("Init");
};

init();