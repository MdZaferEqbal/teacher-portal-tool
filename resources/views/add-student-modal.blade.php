<div class="modal fade customModalBlur" id="custom-add-student-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel">Teacher-Portal | Add Student</h5>
          <button type="button" class="btn-close bg-transparent border-0 text-danger" onclick="hideModal()">
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center align-items-center p-5">
                <form>
                    @csrf
                    <x-custom-input label="Student Name" id="ttp-name" name="name" placeholder="Student Name" value="{{old('name')}}" icon='<i class="fa-solid fa-signature"></i>' type="text" required="TRUE" />
                    <x-custom-input label="Subject" id="ttp-subject" name="subject" placeholder="Subject" value="{{old('subject')}}" icon='<i class="fa-solid fa-s"></i>' type="text" required="TRUE" />
                    <x-custom-input label="Marks" id="ttp-marks" name="marks" value="{{old('marks')}}" icon='<i class="fa-solid fa-star-half-stroke"></i>' placeholder="100" type="number" min="0" max="100" required="TRUE" />
                    <button class="btn btn-dark w-100 add-student-btn" onclick="addStudent()" type="button">Add</button>
                    <button class="btn btn-dark custom-loader w-100 d-none" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Adding...</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="modal-footer text-center" style="min-height: 10vh">
            <div id="custom-success-message" class="text-success text-center"></div>
            <div id="custom-error-message" class="text-danger text-center"></div>
        </div>
      </div>
    </div>
</div>
