// APP BRIDGE ALL ACTIONS INITIALIZE START
var currentPagePath = window.location.pathname;
console.log(currentPagePath);
  var AuthCode = actions.AuthCode,
    Button = actions.Button,
    ButtonGroup = actions.ButtonGroup,
    Scanner = actions.Scanner,
    Cart = actions.Cart,
    Client = actions.Client,
    Flash = actions.Flash,
    Features = actions.Features,
    FeedbackModal = actions.FeedbackModal,
    Fullscreen = actions.Fullscreen,
    Toast = actions.Toast,
    History = actions.History,
    LeaveConfirmation = actions.LeaveConfirmation,
    Loading = actions.Loading,
    Modal = actions.Modal,
    ModalContent = actions.ModalContent,
    Print = actions.Print,
    Redirect = actions.Redirect,
    ResourcePicker = actions.ResourcePicker,
    TitleBar = actions.TitleBar,
    MarketingExternalActivityTopBar = actions.MarketingExternalActivityTopBar,
    ContextualSaveBar = actions.ContextualSaveBar,
    Share = actions.Share,
    NavigationMenu = actions.NavigationMenu,
    ChannelMenu = actions.ChannelMenu,
    AppLink = actions.AppLink,
    Pos = actions.Pos,
    Performance = actions.Performance,
    isAppBridgeAction = actions.isAppBridgeAction,
    Group = actions.Group,
    ComponentType = actions.ComponentType;

  // APP BRIDGE ALL ACTIONS INITIALIZE END

  // APP UTILS ALL ACTIONS INITIALIZE START
  var setupModalAutoSizing = utils.setupModalAutoSizing,
    createMutationObserver = utils.createMutationObserver,
    isMobile = utils.isMobile,
    isShopifyMobile = utils.isShopifyMobile,
    isShopifyPOS = utils.isShopifyPOS,
    isShopifyPing = utils.isShopifyPing,
    getSessionToken = utils.getSessionToken,
    authenticatedFetch = utils.authenticatedFetch,
    getAuthorizationCodePayload = utils.getAuthorizationCodePayload,
    userAuthorizedFetch = utils.userAuthorizedFetch;

  // APP UTILS ALL ACTIONS INITIALIZE END
  // COMMON PAGE FUNCTIONS START
  const loading = Loading.create(app);
  const toastOptions = { message: 'MSG', duration: 3000};
  const toastNotice = Toast.create(app, toastOptions);
  ShopifyFuncs = function() {
    this.flashError = function(msg) {
      toastNotice.set({ message: msg,isError: true });
      toastNotice.dispatch(Toast.Action.SHOW);
    }
    this.flashNotice = function(msg) {
      toastNotice.set({ message: msg,isError: false });
      toastNotice.dispatch(Toast.Action.SHOW);
    }
    this.Bar = {
      loadingOn: function() {
        loading.dispatch(Loading.Action.START);
      },
      loadingOff: function() {
        loading.dispatch(Loading.Action.STOP);
      }
    };
  }
  //Loader Code 
  var svgSpinner = "<section id='sketch_load_global'> <div id='sketch_load_top' class='sketch_load_mask'> <div class='sketch_load_plane'></div> </div> <div id='sketch_load_middle' class='sketch_load_mask'> <div class='sketch_load_plane'></div> </div> <div id='sketch_load_bottom' class='sketch_load_mask'> <div class='sketch_load_plane'></div> </div> <p class='sketch_load_text'><i>LOADING...</i></p> </section> ";
  $.LoadingOverlaySetup({
    image: "",
    custom: "<div class='row text-center'><div class='col-sm-12'>" + svgSpinner + "</div><div class='col-sm-12'></div></div>",
  });
  var ShopifyApp = new ShopifyFuncs();
  // TO SET PAGE PATH OR SET UGLY PAGE URL TO CLEAN URL START

  const history = History.create(app);
  history.dispatch(History.Action.PUSH, currentPagePath);

  // TO SET PAGE PATH OR SET UGLY PAGE URL TO CLEAN URL END

  const dashboardLink = AppLink.create(app, {
    label: 'Dashboard',
    destination: '/',
  });

  const settingLink = AppLink.create(app, {
    label: 'Settings',
    destination: '/settings',
  });

  const customerLink = AppLink.create(app, {
    label: 'Customers',
    destination: '/customers',
  });

  const integrationLink = AppLink.create(app, {
    label: 'Integration',
    destination: '/integrations',
  });

  const apikeyLink = AppLink.create(app, {
    label: 'API Keys Setting',
    destination: '/api-key-settings',
  });
  const planLink = AppLink.create(app, {
    label: 'Plans & Pricing',
    destination: '/plans',
  });
  const instructionLink = AppLink.create(app, {
    label: 'Instruction',
    destination: '/instruction',
  });
  
  var navLinks = [dashboardLink, settingLink,customerLink,integrationLink,apikeyLink,planLink,instructionLink];

  var navLinksPath = ['/', '/settings','/customers','/integrations','/api-key-settings','/plans','/instruction'];

  var activePage = (navLinksPath.indexOf(currentPagePath) == -1) ? undefined : navLinks[navLinksPath.indexOf(currentPagePath)];
  const installationMenu = NavigationMenu.create(app, {
    items: [dashboardLink, settingLink,customerLink,integrationLink,apikeyLink,planLink,instructionLink],
    active: activePage
  });
  // This is add For bundle Discount
  var shopifyAuthenticatedFetch = utils.authenticatedFetch(app);
  const redirect = Redirect.create(app);
  //Navigation Redirection code
  function redirectNavigation(pageName){
    console.log(pageName);
    redirect.dispatch(Redirect.Action.APP, '/'+pageName);

  }
