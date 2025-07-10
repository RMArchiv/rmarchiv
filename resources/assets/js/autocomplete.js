import { autocomplete } from "@algolia/autocomplete-js";
import "@algolia/autocomplete-theme-classic";
import axios from "axios";

/**
 * Unified configuration of autocomplete
 * A find autocomplete will try to set an input container using inputSelector
 * @typedef {{apiPath:Function,placeholder:string,detachedMediaQuery?:string|"none"|"",searchbarSelector:string,panelSelector:string,inputSelector:string|undefined,noResults:string,type:"games"|"list",action:"find"|"navigate"|"findId",limit:number,changeInputOnChange:boolean,additionalProps:Object,additionalSourceProps:Object}} AutocompleteConfig
 */
/**
 *
 * @param {AutocompleteConfig} config
 */
export function createAutocomplete({
  apiPath,
  placeholder = "Search",
  searchbarSelector,
  panelSelector, // not used cause not needed and can break layout
  inputSelector,
  noResults,
  type = "list",
  action = "find",
  limit,
  changeInputOnChange = true,
  additionalProps = {},
  additionalSourceProps = {},
}) {
  const autocompleteSearch = autocomplete({
    container: `${searchbarSelector}`,
    classNames: {
      panel: 'autocomplete-panel-highest',
    },
    getSources() {
      return [
        {
          sourceId: "querySuggestions",
          getItems({ query }) {
            // set input value on evry change
            if (inputSelector && changeInputOnChange) {
              /** @type HTMLInputElement */
              let input = document.querySelector(inputSelector);
              if (input) {
                input.value = query.toString();
              }
            }
            return axios.get(`/${apiPath()}/${query}`).then((result) => {
              if (limit && typeof limit === "number") {
                return result.data.slice(0, limit)
              }
              else {
                return result.data;
              }
            });
          },
          onSelect: (params) => {
            switch (action) {
              case "navigate":
                if (params?.item?.link) {
                  params.navigator.navigate({
                    itemUrl: params?.item?.link?.toString(),
                    item: params.item,
                    state: params.state,
                  });
                }
                break;

              // returns id of searched element
              case "findId":
                params.setQuery(params?.item?.value.toString());
                // Input should be hidden as user primarily interacts with search bar
                if (inputSelector) {
                  /** @type HTMLInputElement */
                  let input = document.querySelector(inputSelector);
                  if (input) {
                    input.value = params?.item?.id.toString();
                  }
                }
                break;

              // returns value of searched element
              default:
                params.setQuery(params?.item?.value.toString());
                // Input should be hidden as user primarily interacts with search bar
                if (inputSelector) {
                  /** @type HTMLInputElement */
                  let input = document.querySelector(inputSelector);
                  if (input) {
                    console.log(JSON.stringify(params))
                    input.value = params?.item?.value.toString();
                  }
                }
                break;
            }
          },
          templates: {
            noResults({ state, source, html }) {
              return html`<div class="empty-message text-white">${noResults}</div>`;
            },
            item({ item, components, html }) {
              if (type == "games") {
                return html`<div class="card">
                <div class="px-3 py-2">
                    <a href='${item.link}' class="d-flex flex-nowrap mb-2 justify-content-between">
                        <div class="d-flex gap-3">
                          <div class="d-flex flex-nowrap">
                            ${
                              item?.gameType && item?.gameTypeShort
                                ? html` <div class="typeiconlist">
                                    <span class="typei type_${item?.gameTypeShort}"
                                          title="${item?.gameType}"
                                    >
                                      ${item?.gameType}
                                    </span>
                                  </div>`
                                : ""
                            }
                            <div class="platformiconlist">
                                <a href="${item?.makerLink}">
                                    <span class="typei type_${
                                      item?.makerShort
                                    }" title="${item?.maker}">
                                        ${item?.maker}
                                    </span>
                                </a>
                            </div>
                          </div>
                          <a href="${item?.urlGame}">
                          ${item?.title}
                          ${
                            item?.subtitle
                            ? html`<small> - ${item.subtitle}</small>`
                            : ""
                          }
                          </a>
                        </div>
                        <span>
                            <img src="/assets/lng/16/${
                              item.languageIconURLSegment
                            }.png" title="${item.language}">
                        </span>
                    </a>
                </div>


                        <a class="float-end" href="${
                          item?.link
                        }"><span class="badge">${item?.comments}</span></a>
                        <a class="float-start" href="${item?.link}">
                            <img width="100px" class="img-fluid img-rounded me-2" src='${
                              item?.screenshot
                            }' alt='${
                  item.translation.titleScreenAlt
                }' title='${item.translation.titleScreenAlt}'/>
                        </a>
                        <div class="thread-info">
                            <div style="font-size:10px">
                                ${item.description.length < 100 ? item.description : item.description.substr(0,100)+"…"}
                            </div>
                            <div class="w-100 float-start" style="font-size: 12px;">
                              <div class="d-flex flex-wrap my-1 justify-content-between">
                                <a href="${item?.link}" class="fs-7">${item.developers}</a>
                                <small class="d-flex gap-1 align-items-center text-nowrap"><a href="" class="fa fa-calendar-days"></a>
                                  <span>${item.release}</span>
                                </small>
                                ${ item.hasCdc
                                    ? html`
                                        <div class="cdcstack">
                                          <img
                                            src="/assets/cdc.png"
                                            title="${item.translation.coupdecoeur}"
                                            alt="${item.translation.coupdecoeur}"
                                          />
                                        </div>
                                      `
                                    : ""
                                }

                              </div>
                              <img src='/assets/rate_up.gif' alt='${
                                  item?.translation?.rate_up
                                }'/> ${item.votesUp} -
                              <img src='/assets/rate_down.gif' alt='${
                                  item?.translation?.rate_down
                                }'/> ${item.votesDown}
                              <span> • </span>
                              AVG: ${item.average} ${
                                  item.average > 0
                                    ? html`<img
                                        src="/assets/rate_up.gif"
                                        alt="${item?.translation?.rate_up}"
                                      />`
                                    : item.average == 0
                                    ? html`<img
                                        src="/assets/rate_neut.gif"
                                        alt="${item?.translation?.rate_neut}"
                                      />`
                                    : html`<img
                                        src="/assets/rate_down.gif"
                                        alt="${item?.translation?.rate_down}"
                                      />`
                                }
                                <!-- TO-DO TAGS -->
                            </div>
                        </div>
                </div>
            </div>
            `;
              } else {
                return html`<p><strong class="text-white">${item.value}</strong></p>`;
              }
            },
          },
          ...additionalSourceProps,
        },
      ];
    },
    ...additionalProps
  });
}
