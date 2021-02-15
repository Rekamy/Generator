import "@/core/components/datatable/node_modules/datatables.net";
import "@/core/components/datatable/node_modules/datatables.net-buttons";
import "@/core/components/datatable/node_modules/datatables.net-responsive";

import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.print";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.colVis";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.html5";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.flash";

import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.print.js.js";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.colVis.js.js";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.html5.js.js";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.flash.js.js";

import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.print.min.js.js";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.colVis.min.js.js";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.html5.min.js.js";
import "@/core/components/datatable/node_modules/datatables.net-buttons/js/buttons.flash.min.js.js";


export default {
    install(Vue) {
      Vue.component(Badge.name, Badge);
      Vue.component(BaseAlert.name, BaseAlert);
      Vue.component(BaseButton.name, BaseButton);
      Vue.component(BaseInput.name, BaseInput);
      Vue.component(BaseNav.name, BaseNav);
      Vue.component(BaseDropdown.name, BaseDropdown);
      Vue.component(BaseCheckbox.name, BaseCheckbox);
      Vue.component(BasePagination.name, BasePagination);
      Vue.component(BaseProgress.name, BaseProgress);
      Vue.component(BaseRadio.name, BaseRadio);
      Vue.component(BaseSlider.name, BaseSlider);
      Vue.component(BaseSwitch.name, BaseSwitch);
      Vue.component(BaseTable.name, BaseTable);
      Vue.component(BaseHeader.name, BaseHeader);
      Vue.component(Card.name, Card);
      Vue.component(StatsCard.name, StatsCard);
      Vue.component(Modal.name, Modal);
      Vue.component(TabPane.name, TabPane);
      Vue.component(Tabs.name, Tabs);
    }
  };
