import { autocomplete } from "@algolia/autocomplete-js";
import "@algolia/autocomplete-theme-classic";
import axios from "axios";

/**
 * Unified configuration of autocomplete
 * A find autocomplete will try to set an input container using inputSelector
 * @typedef {{apiPath:Function,placeholder:string,searchbarSelector:string,panelSelector:string,inputSelector:string|undefined,noResults:string,type:"games"|"list",action:"find"|"navigate",limit:number,changeInputOnChange:boolean,additionalProps:Object}} AutocompleteConfig
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
}) {
  const autocompleteSearch = autocomplete({
    container: `${searchbarSelector}`,
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

              default:
                params.setQuery(params?.item?.value.toString());
                // Input should be hidden as user primarily interacts with search bar
                if (inputSelector) {
                  /** @type HTMLInputElement */
                  let input = document.querySelector(inputSelector);
                  if (input) {
                    input.value = params?.item?.value.toString();
                  }
                }
                break;
            }
          },
          templates: {
            noResults({ state, source, html }) {
              return html`<div class="empty-message">${noResults}</div>`;
            },
            item({ item, components, html }) {
              if (type == "games") {
                return html`<div class="card">
                <div class="card-header">
                    <a href='${item.link}'>
                        ${
                          item?.gameType && item?.gameTypeShort
                            ? html` <span class="typeiconlist">
                                <span
                                  class="typei type_${item?.gameTypeShort} "
                                  title="${item?.gameType}"
                                >
                                  ${item?.gameType}
                                </span>
                              </span>`
                            : ""
                        }
                        <span class="platformiconlist">
                            <a href="${item?.makerLink}">
                                <span class="typei type_${
                                  item?.makerShort
                                }" title="${item?.maker}">
                                    ${item?.maker}
                                </span>
                            </a>
                        </span>
                        <a href="${item?.urlGame}">
                            ${item?.title}
                            ${
                              item?.subtitle
                                ? html`<small> - ${item.subtitle}</small>`
                                : ""
                            }
                        </a>
                        <span>
                            <img src="/assets/lng/16/${
                              item.languageIconURLSegment
                            }.png" title="${item.language}">
                        </span>
                    </a>
                </div>

                <ul class="list-group">
                    <li class="list-group-item media" style="margin-top: 0px;">
                        <a class="float-end" href="${
                          item?.link
                        }"><span class="badge">${item?.comments}</span></a>
                        <a class="float-start" href="${item?.link}">
                            <img width="100px" class="img-fluid img-rounded" src='${
                              item?.screenshot
                            }' alt='${
                  item.translation.titleScreenAlt
                }' title='${item.translation.titleScreenAlt}'/>
                        </a>
                        <div class="thread-info">
                            <div class="media-heading">
                                ${item.description}
                                ${
                                  item.hasCdc
                                    ? html`
                                        <div class="cdcstack">
                                          <img
                                            src="/assets/cdc.png"
                                            title="${item.translation
                                              .coupdecoeur}"
                                            alt="${item.translation
                                              .coupdecoeur}"
                                          />
                                        </div>
                                      `
                                    : ""
                                }
                            </div>
                            <div class="media-body" style="font-size: 12px;">
                                <div>${item.developers}</div>
                                <div>${
                                  item?.translation?.released
                                    ? item.translation.released
                                    : "release date"
                                }: ${item.release}</div>
                                <span> • </span>
                                ${
                                  (item?.translation?.created
                                    ? item?.translation?.created
                                    : "hinzugefügt") +
                                  " " +
                                  item.created
                                }
                                <span> • </span>
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
                    </li>
                </ul>


                </div>
            </div>
            `;
              } else {
                return html`<p><strong>${item.value}</strong></p>`;
              }
            },
          },
          ...additionalProps,
        },
      ];
    },
  });
}
