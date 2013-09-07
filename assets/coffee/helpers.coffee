$.fn.spinXXX = (opts) ->
  @each ->
    $this = $(this)
    data = $this.data()
    if data.spinner
      $this.removeClass 'spin-xxx-faded'
      data.spinner.stop()
      delete data.spinner
    if opts isnt false
      $this.addClass 'spin-xxx-faded'
      data.spinner = new Spinner($.extend(
        color: $this.css("color")
      , opts)).spin(this)

  this
  
helpers =
  ###############################################################################################################################
  #                             Form
  ###############################################################################################################################
  form:
    serializeObject: (formSelector)->
      serializedArray   = $(formSelector).serializeArray()
      serializedObject  = {}
      for formEl in serializedArray 
        formEl.name = formEl.name.replace '[', '.'
        formEl.name = formEl.name.replace ']', ''
        fields = formEl.name.split('.')
        unless serializedObject[ fields[0] ]?
          if fields.length is 1
            serializedObject[ fields[0] ] = formEl.value
          else
            nestedObj = {}
            nestedObj[fields[1]] = formEl.value
            serializedObject[ fields[0] ] = nestedObj
        else
          serializedObject[ fields[0] ][ fields[1] ] = formEl.value
        
      serializedObject
  ###############################################################################################################################
  #                             Alert
  ###############################################################################################################################
  alert: 
    container_selector: ".main-content"
    setTargerContainer: (target)->
      @container_selector = target
      @
      
    setStatus: (status) ->
      @status = status
      switch status
        when ("success")
          @strong = I18N.__("Well done!")
        when ("error")
          @strong = I18N.__("Oh snap!")
        when ("info")
          @strong = I18N.__("Heads up!")
        else
          @strong = I18N.__("Heads up!")
      this

    setMessage: (message) ->
      @message = message
      this

    render: (framework)->
      $(".alert-box").remove()
      if framework is 'foundation'
        html = """
          <div class="alert-box #{@status}" >
          #{@message}
          <a href="#" class="close">&times;</a>
          </div>
        """
      else if framework is 'bootstrap'
        html = "<div class=\"alert alert-" + @status + "\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"></button><strong>" + @strong + "</strong> " + @message
      $(@container_selector).prepend html
      
      $('html, body').animate 
         scrollTop: ( $(@container_selector)?.offset()?.top - $(@container_selector).height() )
      , 1000
    
    hide: -> 
      $(".alert").remove()
      
  ###############################################################################################################################
  #                             Loading mask
  ###############################################################################################################################
  loadingMask:
    show: (target)-> 
      tarenHeight = $(target).css "height"
      do $(target).spinXXX 
      
      
    hide: (target)-> 
      $(target).removeClass 'faded'
      $(target).spinXXX off
      
  ###############################################################################################################################
  #                             AJAX
  ###############################################################################################################################
  
 
  ajax:
    ###
    params.url
    params.targetEl
    params.type (GET, POST)
    params.data
    params.cbSuccess
    params.async
    ###
    request: (params) -> 
      type = undefined
      data = undefined
      if typeof params.type isnt "undefined" and params.type isnt null
        type = params.type
      else
        type = "GET" 
      if typeof params.data isnt "undefined" and params.data isnt null
        data = params.data
      else
        data = {}
        
      targetEl = $(params.targetEl)
      if targetEl.length is 0
        targetEl = $('body')

      data.ajax = on 
      
      if params.async?
        async = params.async 
      else
        async = true
        
      helpers.loadingMask.show targetEl
      curDate = new Date()
      timezoneOffset = (curDate.getTimezoneOffset() / 60)
      $.ajax
        url: SYS.baseUrl + params.url + "?t=" + curDate.getTime() + "&timezoneOffset=#{timezoneOffset}"
        dataType: "json"
        type: type
        data: data
        async: async
        success: (res) ->
          if (not res.success) and (res.data.status is 'not_auth')
            location.href = SYS.baseUrl + 'admin/session/login'
          
          params.cbSuccess res  if params.cbSuccess

        complete: ->
          helpers.loadingMask.hide targetEl

        error: (jqXHR, textStatus, errorThrown) -> 
          return false 
    
    get:  (params) ->
      params.type = "GET"
      @request params
      
    post:  (params) ->
      params.type = "POST"
      @request params
      