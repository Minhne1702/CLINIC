*AppointmentModel*.php: Lưu thông tin đặt lịch hẹn trực tuyến hoặc trực tiếp tại quầ, quản lý trạng thái xác nhận và lý do hủy lịch
*AuditLogModel*: Ghi lại nhật ký hoạt động của mọi tài khoản, theo dõi biến động dữ liệu (giá trị cũ và mới) để phục vụ tra cứu bảo mật.
*BillModel*: (Model tổng hợp tùy chỉnh) Quản lý nhanh danh sách hóa đơn chờ, thống kê doanh thu và lịch sử thanh toán hằng ngày.
*ClinicModel*: Danh sách các chuyên khoa của phòng khám và quản lý trạng thái hoạt động của từng khoa.
*DiseaseCategoryModel*: Phân nhóm các loại bệnh lý để quản lý danh mục và hỗ trợ hệ thống gợi ý thuốc.
*DiseaseCategoryToDrugMapModel*: (Tầng 1 Mapping) Liên kết nhóm bệnh bao quát với các nhóm thuốc phù hợp.
*DiseaseDrugGroupMapModel*: (Tầng 2 Mapping) Gợi ý các nhóm thuốc linh hoạt phù hợp với từng mã bệnh cụ thể.
*DiseaseToSpecificDrugMapModel*: (Tầng 3 Mapping) Mapping bệnh cụ thể với các loại thuốc bắt buộc theo phác đồ điều trị.
*DiseaseModel*: Danh mục chi tiết các loại bệnh theo mã chuẩn ICD-10 và các triệu chứng phổ biến.
*DispensingLogModel*: Nhật ký phát thuốc thực tế, theo dõi dược sĩ thực hiện và lô thuốc cụ thể được xuất từ kho.
*DoctorModel*: Hồ sơ chuyên môn của bác sĩ, bao gồm mã bác sĩ, chuyên khoa, bằng cấp và tiểu sử.
*DoctorScheduleModel*: Quản lý lịch làm việc cụ thể của bác sĩ theo ngày, ca, phòng và chuyên khoa.
*DrugCategoryModel*: Phân nhóm các loại thuốc như kháng sinh, vitamin để quản lý kho và kê đơn.DrugModel: Danh mục chi tiết các loại thuốc, hoạt chất, hàm lượng, đơn vị tính và các tác dụng phụ.
*InventoryItemModel*: Quản lý kho thuốc theo số lô, theo dõi hạn sử dụng và thiết lập ngưỡng cảnh báo tồn kho.
*InvoiceItemModel*: Chi tiết từng hạng mục trong hóa đơn (thuốc, dịch vụ) và lưu giá tại thời điểm xuất hóa đơn.
*InvoiceModel*: Quản lý thông tin tổng quan hóa đơn, mã hóa đơn, tổng tiền thực thu và mức giảm trừ BHYT.
*LabOrderModel*: Phiếu chỉ định xét nghiệm hoặc chẩn đoán hình ảnh (Lab/Imaging) và cập nhật kết quả từ kỹ thuật viên.
*MedicalRecordModel*: Hồ sơ bệnh án chi tiết cho mỗi lần khám, lưu triệu chứng, chẩn đoán và mã ICD-10.
*MfaTokenModel*: Quản lý mã OTP xác thực (6 chữ số), kênh gửi (SMS/Email) và thời gian hết hạn.
*NotificationModel*: Quản lý thông báo gửi qua SMS, Email hoặc Push Notification cho người dùng.
*PatientModel*: Lưu trữ hồ sơ cá nhân, mã bệnh nhân, căn cước công dân, thẻ BHYT và tiền sử bệnh án.
*PaymentModel*: Lưu trữ lịch sử các lần giao dịch thanh toán, phương thức thanh toán (tiền mặt/chuyển khoản).
*PrescriptionItemModel*: Chi tiết từng loại thuốc trong đơn thuốc, liều dùng, hướng dẫn và giá tại thời điểm kê.
*PrescriptionModel*: Đơn thuốc tổng quan cho một lần khám, quản lý trạng thái phát thuốc và chữ ký số bác sĩ.
*QueueEntryModel*: Quản lý số thứ tự xếp hàng chờ khám, phân loại mức độ ưu tiên (cấp cứu, người già, trẻ em).
*RecordFileModel*: Quản lý các file đính kèm hồ sơ bệnh án như file PDF kết quả hoặc ảnh X-quang.
*RoomModel*: Danh sách và trạng thái hoạt động của các phòng khám trong cơ sở.
*RoomShiftModel*: Liên kết phòng, ca làm việc và chuyên khoa để hệ thống biết phòng nào mở vào ca nào.
*ShiftModel*: Định nghĩa các ca làm việc trong ngày (Sáng/Chiều/Tối) với giờ bắt đầu và kết thúc.
*UserModel*: Quản lý tài khoản người dùng, phân quyền (Admin, Bác sĩ, Dược sĩ...) và thông tin đăng nhập.
*UserSessionModel*: Lưu lịch sử đăng nhập, địa chỉ IP, thông tin thiết bị và thời hạn phiên làm việc.
**BillMoel dùng để test nhanh, mốt xóa**