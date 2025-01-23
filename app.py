import os
import telebot
from telebot import types
from datetime import datetime
from keep_alive import keep_alive

keep_alive()

# تنظیمات ربات
BOT_TOKEN = '7547577719:AAEoMyuYY2_DDOhNee94U7C6bLrRUyYHYxE'
SUPPORT_CHANNEL_ID = '@ad_bandekhoda'
REQUIRED_CHANNEL_ID = '@bande_khooda'  # آیدی کانالی که عضویت در آن اجباری است

# فایل‌های مورد نیاز
BLOCKED_USERS_FILE = 'blocked_users.txt'
USERS_FILE = 'users.txt'
ADMINS_FILE = 'admins.txt'

# ایجاد ربات
bot = telebot.TeleBot(BOT_TOKEN)

# تابع ذخیره‌سازی کاربران
def save_user(user_id):
    if not os.path.exists(USERS_FILE):
        open(USERS_FILE, 'w').close()
    with open(USERS_FILE, 'r') as f:
        users = f.read().splitlines()
    if str(user_id) not in users:
        with open(USERS_FILE, 'a') as f:
            f.write(f"{user_id}\n")

# تابع بررسی ادمین بودن کاربر
def is_admin(user_id):
    if not os.path.exists(ADMINS_FILE):
        return False
    with open(ADMINS_FILE, 'r') as f:
        admins = f.read().splitlines()
    return str(user_id) in admins

# تابع بررسی عضویت در کانال
def is_member_of_channel(user_id, channel_id):
    try:
        member_status = bot.get_chat_member(channel_id, user_id).status
        return member_status in ["member", "administrator", "creator"]
    except Exception:
        return False

# افزودن خودکار ادمین اگر در کانال باشد
def add_admin_if_member(user_id):
    if is_member_of_channel(user_id, SUPPORT_CHANNEL_ID):
        if not os.path.exists(ADMINS_FILE):
            open(ADMINS_FILE, 'w').close()
        with open(ADMINS_FILE, 'r') as f:
            admins = f.read().splitlines()
        if str(user_id) not in admins:
            with open(ADMINS_FILE, 'a') as f:
                f.write(f"{user_id}\n")

# هندلر برای دریافت پیام‌های کاربران
@bot.message_handler(commands=['start'])
def handle_start(message):
    user_id = message.chat.id
    save_user(user_id)

    # افزودن خودکار ادمین در صورت عضویت در کانال
    add_admin_if_member(user_id)

    bot.reply_to(message, "سلام! خوش آمدید.")

    # اگر کاربر ادمین باشد، دکمه‌ها را نمایش بده
    if is_admin(user_id):
        markup = types.ReplyKeyboardMarkup(row_width=2, resize_keyboard=True)
        btn1 = types.KeyboardButton('لیست بلاک')
        btn2 = types.KeyboardButton('کاربران ربات')
        btn3 = types.KeyboardButton('افزودن ادمین')
        btn4 = types.KeyboardButton('ارسال پیام همگانی')
        markup.add(btn1, btn2, btn3, btn4)
        bot.send_message(user_id, "لطفاً یکی از گزینه‌ها را انتخاب کنید:", reply_markup=markup)

@bot.message_handler(func=lambda message: message.text == 'لیست بلاک')
def handle_blocked_users(message):
    if os.path.exists(BLOCKED_USERS_FILE):
        with open(BLOCKED_USERS_FILE, 'r') as f:
            blocked_users = f.read().strip()
        response = blocked_users if blocked_users else "هیچ کاربری بلاک نشده است."
    else:
        response = "هیچ کاربری بلاک نشده است."
    bot.reply_to(message, response)

@bot.message_handler(func=lambda message: message.text == 'کاربران ربات')
def handle_users_list(message):
    if os.path.exists(USERS_FILE):
        with open(USERS_FILE, 'r') as f:
            users = f.read().strip()
        response = users if users else "هیچ کاربری ثبت نشده است."
    else:
        response = "هیچ کاربری ثبت نشده است."
    bot.reply_to(message, response)

@bot.message_handler(func=lambda message: message.text == 'افزودن ادمین')
def handle_add_admin(message):
    msg = bot.reply_to(message, "لطفاً آیدی عددی کاربر را وارد کنید:")
    bot.register_next_step_handler(msg, add_admin)

def add_admin(message):
    admin_id = message.text.strip()
    if not admin_id.isdigit():
        bot.reply_to(message, "آیدی وارد شده معتبر نیست.")
        return
    if not os.path.exists(ADMINS_FILE):
        open(ADMINS_FILE, 'w').close()
    with open(ADMINS_FILE, 'r') as f:
        admins = f.read().splitlines()
    if admin_id not in admins:
        with open(ADMINS_FILE, 'a') as f:
            f.write(f"{admin_id}\n")
        bot.reply_to(message, "ادمین با موفقیت اضافه شد.")
    else:
        bot.reply_to(message, "این کاربر قبلاً ادمین بوده است.")

@bot.message_handler(func=lambda message: message.text == 'ارسال پیام همگانی')
def handle_broadcast(message):
    msg = bot.reply_to(message, "لطفاً پیام مورد نظر خود را وارد کنید:")
    bot.register_next_step_handler(msg, broadcast_message)

def broadcast_message(message):
    text = message.text
    if os.path.exists(USERS_FILE):
        with open(USERS_FILE, 'r') as f:
            users = f.read().splitlines()
        for user_id in users:
            try:
                bot.send_message(user_id, text)
            except Exception as e:
                print(f"Error sending message to {user_id}: {e}")
        bot.reply_to(message, "پیام با موفقیت به همه کاربران ارسال شد.")
    else:
        bot.reply_to(message, "هیچ کاربری ثبت نشده است.")

# هندلر برای ارسال پیام مستقیم به کاربر
@bot.message_handler(commands=['msg'])
def handle_direct_message(message):
    try:
        # جدا کردن آیدی و پیام
        parts = message.text.split(maxsplit=2)
        if len(parts) < 3:
            bot.reply_to(message, "فرمت دستور اشتباه است. لطفاً به صورت /msg <آیدی> <پیام> ارسال کنید.")
            return

        user_id = parts[1]
        text = parts[2]

        # ارسال پیام به کاربر
        bot.send_message(user_id, text)
        bot.reply_to(message, "پیام با موفقیت ارسال شد.")
    except Exception as e:
        bot.reply_to(message, f"خطا در ارسال پیام: {e}")

# هندلر برای دریافت پیام‌های کاربران
@bot.message_handler(content_types=['text'])
def handle_message(message):
    # آیدی کاربر
    user_id = message.chat.id

    # بررسی عضویت در کانال اجباری
    if not is_member_of_channel(user_id, REQUIRED_CHANNEL_ID):
        bot.reply_to(message, f"برای ارسال پیام، ابتدا باید عضو کانال زیر شوید:\n{REQUIRED_CHANNEL_ID}")
        return

    # ایجاد پوشه برای ذخیره‌سازی پیام‌ها
    logs_dir = 'logs'
    if not os.path.exists(logs_dir):
        os.makedirs(logs_dir)

    # ایجاد فایل برای ذخیره‌سازی پیام‌های کاربر
    log_file = os.path.join(logs_dir, f"{user_id}.txt")

    # ذخیره‌سازی پیام کاربر
    with open(log_file, 'a') as f:
        f.write(f"[{datetime.now().strftime('%Y-%m-%d %H:%M:%S')}] کاربر: {message.text}\n")

    # ساخت پیام برای ارسال به کانال پشتیبانی
    user_name = message.chat.first_name
    support_message = f"""
👤 نام: {user_name}
🆔 آی‌دی: {user_id}

📩 پیام:
{message.text}
"""

    # ارسال پیام به کانال پشتیبانی
    bot.send_message(SUPPORT_CHANNEL_ID, support_message)

    # ذخیره‌سازی پاسخ ربات
    with open(log_file, 'a') as f:
        f.write(f"[{datetime.now().strftime('%Y-%m-%d %H:%M:%S')}] ربات: درخواست شما به تیم پشتیبانی ارسال شد. به زودی به شما پاسخ داده خواهد شد.\n")

    # ارسال پاسخ اولیه به کاربر
    bot.reply_to(message, "درخواست شما به تیم پشتیبانی ارسال شد. به زودی به شما پاسخ داده خواهد شد.")

# اجرای ربات
if __name__ == '__main__':
    bot.polling()
