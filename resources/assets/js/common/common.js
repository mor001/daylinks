import * as CONSTS from './const';

export const Common = {
    methods: {
    /**
     * 指定した日付からXヶ月後のDateオブジェクトを取得する
     * @param {object} date   - 基準のDateオブジェクト
     * @param {number} months - 何ヶ月先の日付を取得するか
     */
    get_nextmonth_date(date, months) {

      const moment = require('moment');

      // monthsの指定がない場合は翌月を取得
      months = months || 1;
 
      // 基準の年月日を取得
      const year = date.getFullYear();
      const month = date.getMonth();
      const day = date.getDate();
 
      // 基準の年月からDateオブジェクトを生成
      let nextDate = new Date(year, month);
      // 月の設定を変更
      nextDate.setMonth(nextDate.getMonth() + months);
      // 末日を取得
      const lastDay = new Date(nextDate.getFullYear(), nextDate.getMonth() + 1, 0).getDate();
      // 元の日にちが該当月に無い場合はその月の末日を設定する
      if(lastDay < day) {
        nextDate.setDate(lastDay);
      } else {
        nextDate.setDate(day);
      }
      return nextDate;
    }
  }
}
