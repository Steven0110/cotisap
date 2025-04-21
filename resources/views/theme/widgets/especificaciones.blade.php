<div class="an-single-component with-shadow totales">
        <div class="an-component-header">
          <h6>{{ 'Especificaciones adicionales' }}</h6>
        </div>
        <div class="an-component-body">
          <div class="an-helper-block">
              @foreach($especificacionesType as $espType)
                 <option value="">{{ $espType->name }}</option>
              @endforeach
               <select name="" id="">
                <optgroup label="Alaskan/Hawaiian Time Zone" data-select2-id="63">
                  <option value="AK" data-select2-id="64">Alaska</option>
                  <option value="HI" data-select2-id="65">Hawaii</option>
                </optgroup>
             
            </select>
            

          </div>
        </div>
      </div>