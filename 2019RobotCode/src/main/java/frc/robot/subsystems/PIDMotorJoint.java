/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.PIDSubsystem;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;

public class PIDMotorJoint extends PIDSubsystem {
  private double m_encoderPerAngle, m_zeroEncoder, m_targetAngle, m_maxAngle, m_minAngle, m_power;
  private CANSparkMax m_jointMotor;
  private CANEncoder m_jointEncoder;
  private boolean m_reverse;
  
  public PIDMotorJoint(String subsystemName, CANSparkMax jointMotor, double encoderPerAngle, double maxAngle, double minAngle, double power, double kP, double kI, double kD, boolean reverse) {
    
    super(subsystemName, kP, kD, kI);

    m_jointMotor = jointMotor;
    m_jointEncoder = new CANEncoder(m_jointMotor);
    m_encoderPerAngle = encoderPerAngle;
    m_maxAngle = maxAngle;
    m_minAngle = minAngle;
    m_reverse = reverse;
    m_power = power;

    m_zeroEncoder = 0;

    setSetpoint(0);
    //enable();
  }

  public void resetAngle(){
    //System.out.println(m_jointEncoder.getPosition());
    m_zeroEncoder = m_jointEncoder.getPosition();
    setSetpoint(0);
  }

  public double getAngle(){
    return -(m_jointEncoder.getPosition()-m_zeroEncoder)/m_encoderPerAngle;
  }

  @Override
  protected void initDefaultCommand() {
    
  }

  @Override
  protected double returnPIDInput() {
    return getAngle();
  }

  @Override
  protected void usePIDOutput(double output) {
    if (getAngle() < m_minAngle){
      setSetpoint(m_minAngle);
    } else if (getAngle() > m_maxAngle){
      setSetpoint(m_maxAngle);
    } else {
      output*=m_power;
      if (this.getName().equals("wrist")){
        System.out.println(this.getName() + " t: " + m_targetAngle+" c: " + getAngle());
      }
      if (m_reverse)
        output*=-1;
      if (output > 0.3) output = 0.3;
      if (output < -0.3) output = -0.3;
      m_jointMotor.set(output);
      }
  }

  public void setAngle(double targetAngle){
    if (targetAngle <= m_maxAngle && targetAngle >= m_minAngle){
      m_targetAngle = targetAngle;
    }
    setSetpoint(m_targetAngle);
    //System.out.println("current angle: " + getAngle() + " target angle: "+targetAngle);
  }
}
