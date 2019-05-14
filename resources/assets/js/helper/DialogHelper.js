import Vue from 'vue';
import Dialog from '../components/Dialog';

const DialogHelper = {
  async showDialog (context, { subject, message, primaryLabel, secondaryLabel, ok, cancel }) {
    let DialogVM = Vue.extend(Dialog);
    let vm = new DialogVM({
      parent: context,
      propsData: {
        subject: subject,
        message: message,
        primaryLabel: primaryLabel,
        secondaryLabel: secondaryLabel,
      }
    });
    await vm.show().then( (response) => {
        ok()
        vm.close()
    }).catch( (error) => {
        cancel()
        vm.close()
    })
  }
}
export default DialogHelper